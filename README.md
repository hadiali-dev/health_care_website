# HealthCare App - Project Overview

## What This App Does

This is a real-time health tracking application that connects patients with medical staff. Think of it like a digital health neighborhood where:

- **Patients** can report how they're feeling and see nearby patients who are also sick
- **Medical Staff** can monitor patient health and respond quickly when someone needs help

---

## How It Works

### For Patients

1. **Sign Up / Login** - Patients register with their name, email, and basic info
2. **Report Symptoms** - When feeling unwell, patients submit a health report describing their symptoms
3. **Find Nearby Patients** - Using GPS, the app shows other sick patients within a 200-meter radius on a map
4. **Track Health Status** - Patients can see when medical staff marks them as healthy or needing attention

### For Medical Staff

1. **View All Patients** - See a list of all registered patients
2. **Update Health Status** - Mark patients as "healthy" or "needs care" based on their reports
3. **Review Reports** - Read patient-submitted health reports in a unified feed
4. **Delete Old Reports** - Remove outdated or irrelevant reports to keep the system clean

---

## Key Features

| Feature | Description |
|---------|-------------|
| **Location-Based Discovery** | Uses GPS to find sick patients nearby (within 200m) |
| **Health Status Tracking** | Medical staff can update patient health status in real-time |
| **Report System** | Patients submit text reports describing their symptoms |
| **Role-Based Access** | Separate dashboards for patients and medical staff |
| **Secure Authentication** | Session-based login with secure password handling |

---

## Tech Stack

- **Backend**: Laravel 13 (PHP 8.5)
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: PostgreSQL (production) / SQLite (local testing)
- **Maps**: Leaflet.js with OpenStreetMap tiles
- **Authentication**: Laravel Breeze with session-based auth
- **Deployment**: Docker containers on Render

---

## Project Structure (Quick Guide)

```
backend/
├── app/
│   ├── Http/Controllers/    # Handles incoming requests
│   │   ├── Auth/            # Login, register, logout logic
│   │   ├── DashboardController.php   # Main dashboard logic
│   │   ├── MapController.php        # Nearby patient finding
│   │   └── ReportController.php      # Report CRUD operations
│   ├── Models/              # Database models
│   │   ├── User.php         # User data (patients & staff)
│   │   └── Report.php       # Patient health reports
│   └── Providers/           # App configuration
├── database/
│   ├── migrations/          # Database table structure
│   └── factories/           # Test data generators
├── resources/views/
│   ├── dashboard/           # Patient & staff dashboards
│   ├── auth/                # Login/register views
│   └── layouts/             # Shared page layouts
├── routes/web.php           # URL routing rules
└── tests/                   # Automated tests
```

---

## API Endpoints (How the App Talks to Itself)

| Method | Endpoint | Who Can Access | What It Does |
|--------|----------|----------------|--------------|
| GET | `/dashboard` | Patient, Staff | Shows the appropriate dashboard |
| POST | `/reports` | Patient only | Submit a health report |
| GET | `/reports` | Staff only | View all patient reports |
| DELETE | `/reports/{id}` | Staff only | Delete a report |
| POST | `/nearby-patients` | Patient only | Find sick patients nearby |
| PATCH | `/patients/{id}/status` | Staff only | Update patient's health status |

---

## Testing

The app has 51 automated tests covering:
- User registration and login
- Report submission and deletion
- Health status updates
- Map/nearby patient functionality
- Access control (patients can't access staff features and vice versa)

Run tests locally: `php artisan test`

---

## Deployment

The app runs in Docker containers on Render. Key environment variables for production:

- `APP_URL` - Your domain URL (e.g., https://healthcare.onrender.com)
- `APP_ENV` - Set to "production"
- `SESSION_SECURE_COOKIE` - Must be "true" for HTTPS
- `DB_CONNECTION` - "pgsql" for PostgreSQL

---

## Security Features

- **CSRF Protection** - All forms are protected against cross-site request forgery
- **Role-Based Access Control** - Medical staff routes are protected from patient access
- **Soft Deletes** - Deleted users and reports are archived, not permanently removed
- **Secure Sessions** - HTTP-only cookies with secure flag in production
- **Password Hashing** - Uses bcrypt with 12 rounds

---

## Design Decisions

### Why 200 meters for nearby patients?
- Close enough to be meaningfully "nearby" in an urban environment
- Large enough to capture multiple city blocks
- Small enough to be relevant for immediate neighborhood health concerns

### Why use Leaflet/OpenStreetMap?
- Free and open source - no API keys or costs
- Works globally without Google API restrictions
- Sufficient for showing patient locations on a neighborhood scale

### Why PostgreSQL for production?
- More robust than MySQL for Render's managed database offering
- Better handling of concurrent connections
- Built-in JSON support if we expand to store location data as GeoJSON

---

## Future Improvements (If I Had More Time)

1. **Real-time notifications** - Push alerts when a patient nearby reports symptoms
2. **Chat feature** - Allow patients to communicate directly with medical staff
3. **Historical tracking** - Show patient's health history over time
4. **Admin dashboard** - Separate super-admin role for system management
5. **Mobile app** - React Native or Flutter wrapper for native mobile experience
