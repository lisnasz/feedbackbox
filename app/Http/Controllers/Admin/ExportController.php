<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Export feedbacks to CSV
     */
    public function csv(Request $request)
    {
        // Build query based on filters
        $query = Feedback::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $feedbacks = $query->latest()->get();

        // Create CSV content
        $csv = $this->generateCsv($feedbacks);

        $filename = 'pengaduan_' . date('Y-m-d_H-i-s') . '.csv';

        return response($csv, 200)
            ->header('Content-Type', 'text/csv; charset=utf-8')
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }

    /**
     * Export feedbacks to PDF (simple text-based)
     */
    public function pdf(Request $request)
    {
        // Build query based on filters
        $query = Feedback::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $feedbacks = $query->latest()->get();

        // Create PDF content
        $html = $this->generatePdf($feedbacks);

        $filename = 'pengaduan_' . date('Y-m-d_H-i-s') . '.pdf';

        // For simple PDF generation without library, return as HTML for user to print
        // Or use a third-party library like TCPDF or DOMPDF

        return response($html, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }

    /**
     * Generate CSV content
     */
    private function generateCsv($feedbacks)
    {
        $csv = "\xEF\xBB\xBF"; // UTF-8 BOM for Excel

        // Header
        $csv .= implode(',', [
            'ID',
            'Nama',
            'Email',
            'Kategori',
            'Status',
            'Pesan',
            'Tanggapan Admin',
            'Tanggal',
            'IP Address'
        ]) . "\n";

        // Data rows
        foreach ($feedbacks as $feedback) {
            $csv .= implode(',', [
                '"' . $feedback->id . '"',
                '"' . str_replace('"', '""', $feedback->name) . '"',
                '"' . str_replace('"', '""', $feedback->email) . '"',
                '"' . ($feedback->category ? str_replace('"', '""', $feedback->category->name) : '') . '"',
                '"' . $this->translateStatus($feedback->status) . '"',
                '"' . str_replace(["\n", "\r", '"'], [' ', ' ', '""'], $feedback->message) . '"',
                '"' . str_replace(["\n", "\r", '"'], [' ', ' ', '""'], $feedback->admin_response ?? '') . '"',
                '"' . $feedback->created_at->format('Y-m-d H:i:s') . '"',
                '"' . ($feedback->ip_address ?? '') . '"'
            ]) . "\n";
        }

        return $csv;
    }

    /**
     * Generate PDF HTML content
     */
    private function generatePdf($feedbacks)
    {
        $html = <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .meta {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 20px;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
            border: 1px solid #2980b9;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-baru {
            background-color: #e3f2fd;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 12px;
        }
        .status-diproses {
            background-color: #fff3e0;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 12px;
        }
        .status-selesai {
            background-color: #e8f5e9;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 12px;
        }
        .message {
            max-width: 300px;
            word-wrap: break-word;
            font-size: 11px;
        }
        page-break {
            page-break-after: always;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            color: #7f8c8d;
            font-size: 11px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Pengaduan & Saran</h1>
        <div class="meta">
            <p>Dinas Ketahanan Pangan Kabupaten Garut</p>
            <p>Tanggal Laporan: {{DATE}}</p>
            <p>Total Data: {{TOTAL}} pengaduan</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Pesan</th>
                    <th>Tanggapan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                {{ROWS}}
            </tbody>
        </table>

        <footer>
            <p>Dokumen ini dibuat secara otomatis oleh Sistem Manajemen Pengaduan.</p>
            <p>© {{YEAR}} Dinas Ketahanan Pangan Kabupaten Garut. All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>
HTML;

        // Generate table rows
        $rows = '';
        foreach ($feedbacks as $feedback) {
            $statusClass = 'status-' . $feedback->status;
            $rows .= '<tr>';
            $rows .= '<td>' . $feedback->id . '</td>';
            $rows .= '<td>' . htmlspecialchars($feedback->name) . '</td>';
            $rows .= '<td>' . htmlspecialchars($feedback->email) . '</td>';
            $rows .= '<td>' . ($feedback->category ? htmlspecialchars($feedback->category->name) : '-') . '</td>';
            $rows .= '<td><span class="' . $statusClass . '">' . $this->translateStatus($feedback->status) . '</span></td>';
            $rows .= '<td class="message">' . htmlspecialchars(substr($feedback->message, 0, 100)) . '...</td>';
            $rows .= '<td class="message">' . htmlspecialchars(substr($feedback->admin_response ?? '-', 0, 50)) . '</td>';
            $rows .= '<td>' . $feedback->created_at->format('d/m/Y') . '</td>';
            $rows .= '</tr>';
        }

        // Replace placeholders
        $html = str_replace('{{DATE}}', date('d/m/Y H:i:s'), $html);
        $html = str_replace('{{TOTAL}}', count($feedbacks), $html);
        $html = str_replace('{{ROWS}}', $rows, $html);
        $html = str_replace('{{YEAR}}', date('Y'), $html);

        return $html;
    }

    /**
     * Translate status to Indonesian
     */
    private function translateStatus($status)
    {
        $translations = [
            'baru' => 'Baru',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai'
        ];

        return $translations[$status] ?? $status;
    }
}
