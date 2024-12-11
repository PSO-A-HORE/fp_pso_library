<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Book Library: How To Use This App

Simple App CRUD with laravel 10. (CRUD Book / Library)

Book Library adalah aplikasi sederhana yang dirancang untuk mengelola data perpustakaan. Aplikasi ini dibangun dengan fokus pada kesederhanaan dan menggunakan GitHub Actions sebagai CI/CD pipeline untuk otomatisasi deployment.

## Requirments
- php 8.0
- Docker
- MySQL 5.7
- Terraform
- Google Cloud Platform

## Fitur
CRUD Library Book:
 - Tambah buku baru.
 - Lihat daftar buku yang tersedia.
 - Edit informasi buku.
 - Hapus data buku.
Manajemen Data Anggota:
 - Memasukkan nama dan NRP anggota perpustakaan.

## Cara Menggunakan (Dari Sudut Pandang Pengguna)
Mengakses Aplikasi:
 - Buka aplikasi melalui URL https://library-22416837039.asia-southeast2.run.app/.

Manajemen Buku:
- Tambah Buku: Klik tombol "Tambah Buku," isi detail buku (judul, pengarang, dll.), lalu simpan.
- Lihat Buku: Daftar buku ditampilkan di halaman utama.
- Edit Buku: Klik tombol "Edit" di samping buku yang ingin diubah, lakukan perubahan, lalu simpan.
- Hapus Buku: Klik tombol "Hapus" di samping buku yang ingin dihapus.
Manajemen Anggota:
- Isi formulir data anggota perpustakaan seperti nama dan NRP saat pendaftaran.

## Cara Menggunakan (Dari Sudut Pandang Developer)

Menjalankan aplikasi secara lokal
1. Clone Repository
```bash
# Clone repository
git clone https://github.com/PSO-A-HORE/fp_pso_library.git
# Pindah ke direktori proyek
cd fp_pso_library
```

2. Setup Docker dan Docker Compose
```bash
# Jalankan aplikasi menggunakan Docker Compose
docker-compose up --build
```
akses aplikasi di http://localhost:8080.

3. Konfigurasi .env
- Sesuaikan variabel di file .env sesuai kebutuhan, seperti pengaturan database.

# Deployment manual dengan Terraform
1. Masuk ke directory terraform 
2. Menjalankan command `terraform init`
3. Menjalankan command `terraform plan`
4. Menjalankan command `terraform apply`

# Deployment dengan CI/CD (GitHub Actions)
Langkah Konfigurasi:
1. Google Cloud Setup:
   - Buat akun Google Cloud dan aktifkan Cloud Run serta Artifact Registry.
   - Buat database Cloud SQL jika diperlukan.
2. Generate Service Account Key:
   - Buat kunci JSON di Google Cloud Console dan tambahkan ke GitHub Secrets dengan nama ```GCLOUD_SERVICE_KEY ```.
3. Atur Secrets di GitHub:
   - ```PROJECT_ID```: ID proyek Google Cloud Anda.
   - ```REGION```: Lokasi wilayah deployment (contoh: asia-southeast2).
   - ```GCLOUD_SERVICE_KEY```: Kunci JSON akun layanan Google Cloud. yang relevan ke GitHub Secrets.
4. Konfigurasi CI/CD Workflow:
   - Workflow sudah diatur di ```.github/workflows```. Pastikan konfigurasi seperti nama project dan lokasi build sesuai dengan setup Anda.
   - Setup Proyek: Ubah ```PROJECT_ID``` dan ```REGION``` sesuai dengan konfigurasi proyek Google Cloud Anda:
     ```yaml
     env:
     PROJECT_ID: "your-project-id"
     REGION: "your-region"
     ```
   - Login to Google Cloud: Pastikan file JSON kunci akun layanan digunakan dengan benar
     ```yaml
     - name: Authenticate to Google Cloud
       run: echo "${{ secrets.GCLOUD_SERVICE_KEY }}" > key.json
     ```
   - Build & Push Docker Image: Edit nama image dan tag agar sesuai
    ```yaml
     - name: Build and Push Docker Image
       run: |
        docker build -t gcr.io/${{ env.PROJECT_ID }}/library-app .
        docker push gcr.io/${{ env.PROJECT_ID }}/library-app
     ```
   - Deploy to Cloud Run: Sesuaikan nama layanan ```(--service)``` jika berbeda
      ```yaml
     - name: Deploy to Cloud Run
        run: |
        gcloud run deploy library-app \
          --image gcr.io/${{ env.PROJECT_ID }}/library-app \
          --region ${{ env.REGION }} \
          --platform managed \
          --allow-unauthenticated
     ```
5. Push Kode:
   - Push ke branch main untuk memicu pipeline otomatis. Setelah berhasil, aplikasi akan tersedia di Google Cloud Run.

