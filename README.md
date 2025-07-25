# 🗂 File Manager System - Laravel Project

A simple and secure file manager built with Laravel that allows users to upload, list, view, download, and delete their own files within a private personal space.

---

## 🚀 Features

- User authentication (login/register) using Laravel Breeze
- Private file dashboard per user
- Upload files with validation (max 5MB, only PDF, JPG, PNG, DOCX)
- File search by name, format, or size
- Secure storage (files are stored in private disk, not public)
- Download & preview files only by the owner
- Files are organized per user (`storage/app/private/files/user_{id}/`)
- Simple UI with TailwindCSS

---

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/farzane94/file-manager.git
cd file-manager
```

### 2. Install dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Create `.env` file

```bash
cp .env.example .env
```

Edit the `.env` file and set your database configuration:

```env
DB_DATABASE=file_manager
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan key:generate
php artisan migrate
```

---

### 4. Set up storage link (optional for public files)

If needed for public storage:

```bash
php artisan storage:link
```

---

## 🧪 Usage

- Visit `/register` or `/login` to authenticate
- Once logged in, you'll be redirected to your **dashboard**
- Upload files (max 5MB, only PDF/JPG/PNG/DOCX)
- Your files are only visible and accessible to you
- Use the action buttons to download and delete files

---

## 📁 File Storage Structure

Uploaded files are saved in:

```
storage/app/private/files/user_{user_id}/{filename}
```

These files are **not publicly accessible**, and only available via secure Laravel routes.

---

## 🔐 Security Notes

- Users can only access their own files
- All actions are behind authentication
- File display and download routes enforce user ownership
- Validation ensures accepted file types and size limits

---

## 👩‍💻 Developer Notes

- Framework: Laravel
- Auth: Laravel Breeze (Blade + Tailwind)
- File Storage: Laravel `Storage` with custom `private` disk
- Styling: TailwindCSS (no complex frontend framework used)

---

---

## 📬 Contact

Built with 👩‍💻💻🖱️ by Farzaneh Rahmani
