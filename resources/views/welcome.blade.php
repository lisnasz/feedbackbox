<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinas Ketahanan Pangan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2ecc71;
            --secondary: #3498db;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --white: #ffffff;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background-color: var(--white);
        }

        /* Navbar */
        header {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            padding: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo img {
            height: 40px;
            width: auto;
            background: transparent;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            color: var(--white);
            padding: 5rem 2rem;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--white);
            color: var(--secondary);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background-color: var(--primary);
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-secondary:hover {
            background-color: var(--white);
            color: var(--primary);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Section */
        section {
            padding: 4rem 0;
        }

        section h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--dark);
            position: relative;
            padding-bottom: 1rem;
        }

        section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary), var(--primary));
            border-radius: 2px;
        }

        /* Tentang Dinas */
        .about {
            background-color: var(--light);
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-text h3 {
            color: var(--secondary);
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .about-text ul {
            list-style: none;
        }

        .about-text li {
            padding: 0.5rem 0;
            padding-left: 1.5rem;
            position: relative;
        }

        .about-text li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }

        .about-image {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            height: 300px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 3rem;
            overflow: hidden;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Program */
        .programs {
            background-color: var(--white);
        }

        .program-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .program-card {
            background: var(--light);
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s;
            border-top: 4px solid var(--primary);
        }

        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .program-card h3 {
            color: var(--secondary);
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .program-card p {
            color: #555;
            line-height: 1.8;
        }

        /* Berita */
        .news {
            background-color: var(--light);
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .news-card {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .news-image {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 2rem;
            overflow: hidden;
            position: relative;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .news-content {
            padding: 1.5rem;
        }

        .news-date {
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .news-card h3 {
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        /* Feedback Box */
        .feedback-section {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: var(--white);
            padding: 4rem 0;
        }

        .feedback-section h2 {
            color: var(--white);
        }

        .feedback-section h2::after {
            background: rgba(255, 255, 255, 0.3);
        }

        .feedback-container {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--light);
            border-radius: 5px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .error {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .form-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: var(--white);
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .form-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(52, 152, 219, 0.3);
        }

        .form-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 5px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease;
            z-index: 2000;
            max-width: 400px;
        }

        .notification.success {
            background-color: var(--success);
            color: var(--white);
        }

        .notification.error {
            background-color: var(--danger);
            color: var(--white);
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Kontak */
        .contact {
            background-color: var(--light);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .contact-item {
            text-align: center;
        }

        .contact-item h3 {
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .contact-item p {
            color: #555;
            line-height: 1.8;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: var(--white);
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                gap: 1rem;
                font-size: 0.9rem;
            }

            .hero h1 {
                font-size: 1.8rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .about-content {
                grid-template-columns: 1fr;
            }

            section h2 {
                font-size: 1.5rem;
            }

            .feedback-container {
                padding: 1.5rem;
            }

            .notification {
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }

        @media (max-width: 480px) {
            nav {
                padding: 1rem;
            }

            .logo {
                font-size: 1.2rem;
            }

            .nav-links {
                gap: 0.5rem;
                font-size: 0.8rem;
            }

            .hero {
                padding: 2rem 1rem;
            }

            .hero h1 {
                font-size: 1.5rem;
            }

            .hero p {
                font-size: 0.9rem;
            }

            .btn {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }

            .container {
                padding: 0 1rem;
            }

            section {
                padding: 2rem 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <header>
        <nav>
            <a href="/" class="logo">
                <img src="/logdkp.webp" alt="Logo Dinas Ketahanan Pangan">
                <span>Dinas Ketahanan Pangan</span>
            </a>
            <ul class="nav-links">
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#berita">Berita</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <!-- <li><a href="/admin/login" style="font-size: 0.8rem; opacity: 0.7;">Login</a></li> -->
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Mewujudkan Ketahanan Pangan Nasional</h1>
            <p>Dinas Ketahanan Pangan berkomitmen untuk menjamin ketersediaan pangan berkualitas bagi seluruh masyarakat Indonesia</p>
            <a href="#feedback" class="btn btn-primary">Berikan Saran</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="tentang">
        <div class="container">
            <h2>Tentang Dinas Ketahanan Pangan</h2>
            <div class="about-content">
                <div class="about-text">
                    <h3>Visi & Misi Kami</h3>
                    <p>Dinas Ketahanan Pangan adalah lembaga pemerintah yang bertanggung jawab dalam mengurus segala hal berkaitan dengan pangan di wilayah yang menjadi kewenangan kerja kami.</p>
                    <h3 style="margin-top: 1.5rem;">Tugas Utama:</h3>
                    <ul>
                        <li>Menjamin ketersediaan pangan yang cukup dan terjangkau</li>
                        <li>Meningkatkan kualitas dan keamanan pangan</li>
                        <li>Mengembangkan pertanian berkelanjutan</li>
                        <li>Memberikan perlindungan kepada petani lokal</li>
                        <li>Mengurangi stunting dan malnutrisi</li>
                        <li>Melakukan pengawasan keamanan pangan</li>
                    </ul>
                </div>
                <div class="about-image">
                    <img src="/dkp.jpg" alt="Dinas Ketahanan Pangan">
                </div>
            </div>
        </div>
    </section>
    <!-- News Section -->
    <section class="news" id="berita">
        <div class="container">
            <h2>Berita Terbaru</h2>
            <div class="news-grid">
                <div class="news-card">
                    <div class="news-image">
                        <img src="/dkp001.png" alt="Komitmen Ketahanan Pangan Kabupaten Garut">
                    </div>
                    <div class="news-content">
                        <h3>Komitmen Ketahanan Pangan Kabupaten Garut</h3>
                        <p>Dinas Ketahanan Pangan Kabupaten Garut berkomitmen untuk terus membangun kedaulatan dan ketahanan pangan sebagai fondasi Indonesia yang kuat. Upaya berkelanjutan dilakukan untuk memastikan setiap masyarakat memiliki akses terhadap pangan yang cukup dan bergizi.</p>
                    </div>
                </div>
                <div class="news-card">
                    <div class="news-image">
                        <img src="/dkp002.png" alt="Kunjungan Lapangan ke Desa Sirnajaya">
                    </div>
                    <div class="news-content">
                        <h3>Kunjungan Lapangan ke Desa Sirnajaya</h3>
                        <p>Upaya pemberian bantuan kepada masyarakat rentan rawan pangan terus dilakukan sebagai bentuk tanggung jawab sosial kami. Kepala Dinas Ketahanan Pangan Yani Yuliani, S.P., M.P beserta jajaran melakukan kunjungan ke lapangan di Desa Sirnajaya, Kecamatan Tarogong Kaler untuk memastikan program berjalan efektif dan tepat sasaran.</p>
                    </div>
                </div>
                <div class="news-card">
                    <div class="news-image">
                        <img src="/dkp003.png" alt="Raih Juara 3 SiPangan Daerah Award 2025">
                    </div>
                    <div class="news-content">
                        <h3>Raih Juara 3 SiPangan Daerah Award 2025</h3>
                        <p>Dinas Ketahanan Pangan Kabupaten Garut berhasil meraih Juara 3 pada Gelaran SiPangan Daerah Award 2025 yang diselenggarakan oleh Badan Pangan Nasional di Hotel Santika, Kota Depok. Penghargaan ini membuktikan komitmen kami dalam membangun sistem pangan yang berkelanjutan dan inklusif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="feedback-section" id="feedback">
        <div class="container">
            <h2>Kotak Saran & Pengaduan</h2>
            <div class="feedback-container">
                <form id="feedbackForm" onsubmit="submitFeedback(event)">
                    <div class="form-group">
                        <label for="name">Nama Lengkap <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required>
                        <div class="error" id="name-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span style="color: var(--danger);">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                        <div class="error" id="email-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori <span style="color: var(--danger);">*</span></label>
                        <select id="category" name="category" required>
                            <option value="">-- Pilih Kategori --</option>
                        </select>
                        <div class="error" id="category-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="message">Pesan <span style="color: var(--danger);">*</span></label>
                        <textarea id="message" name="message" placeholder="Tulis saran, kritik, pengaduan, atau pertanyaan Anda..." required></textarea>
                        <div class="error" id="message-error"></div>
                    </div>

                    <button type="submit" class="form-button" id="submitBtn">Kirim Saran</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="kontak">
        <div class="container">
            <h2>Hubungi Kami</h2>
            <div class="contact-grid">
                <div class="contact-item">
                    <h3> Alamat</h3>
                    <p>Jl. Terusan Pahlawan No.70, Sukagalih, Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151</p>
                </div>
                <div class="contact-item">
                    <h3> Telepon</h3>
                    <p>(0262) 2801757</p>
                </div>
                <div class="contact-item">
                    <h3>Media Sosial</h3>
                    <p>Tiktok: @dkp_garut<br>Instagram: @dkp_garut</p>
                </div>
                <div class="contact-item">
                    <h3> Jam Kerja</h3>
                    <p>Senin - Kamis: 07.30 - 16:00<br> Jum'at 07.30 - 16.30<br> Sabtu - Minggu: Tutup</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Dinas Ketahanan Pangan. Semua Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        // Load categories from API
        document.addEventListener('DOMContentLoaded', function() {
            loadCategories();
        });

        function loadCategories() {
            fetch('/api/categories')
                .then(response => response.json())
                .then(categories => {
                    const categorySelect = document.getElementById('category');
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading categories:', error);
                    // Fallback to default categories if API fails
                    const categorySelect = document.getElementById('category');
                    const defaultCategories = ['Saran', 'Kritik', 'Pengaduan', 'Pertanyaan'];
                    defaultCategories.forEach(cat => {
                        const option = document.createElement('option');
                        option.value = cat;
                        option.textContent = cat;
                        categorySelect.appendChild(option);
                    });
                });
        }

        // Clear error messages when user starts typing
        document.getElementById('feedbackForm').querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', () => {
                const errorElement = document.getElementById(field.name + '-error');
                if (errorElement) {
                    errorElement.textContent = '';
                }
            });
        });

        // Submit feedback form
        function submitFeedback(event) {
            event.preventDefault();

            const form = document.getElementById('feedbackForm');
            const submitBtn = document.getElementById('submitBtn');
            const formData = new FormData(form);

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengirim...';

            fetch('/feedback', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    form.reset();
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Kirim Saran';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan jaringan. Silakan coba lagi.', 'error');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Kirim Saran';
            });
        }

        // Show notification
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
