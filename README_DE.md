# Benutzeroverwaltungs-Webanwendung

## Überblick
Ein vollständiges Benutzerverwaltungssystem, entwickelt mit Laravel 12 und Livewire, mit rollenbasierter Zugriffskontrolle, CRUD-Operationen und umfassenden Sicherheitsmaßnahmen.

## Implementierte Funktionen
✅ **Authentifizierungssystem**
- Benutzername/Passwort-Anmeldung
- Abmelde-Funktionalität  
- Session-Verwaltung

✅ **Rollenbasierte Zugriffskontrolle**
- Admin- und Benutzer-Rollen
- Nur-Admin-Benutzerverwaltungsbereich
- Middleware-Schutz

✅ **Benutzerverwaltung (Nur Admin)**
- Alle Benutzer in paginierter Tabelle anzeigen
- Neue Benutzer erstellen
- Bestehende Benutzer bearbeiten (Benutzername, E-Mail, Passwort, Rolle)
- Benutzer löschen (mit Schutz gegen Selbstlöschung)
- Suchfunktionalität

✅ **Sicherheitsfeatures**
- SQL-Injection-Prävention (Eloquent ORM)
- XSS-Prävention (Blade-Templating)
- CSRF-Schutz (Laravel integriert)
- Starke Passwort-Anforderungen
- Sichere Passwort-Verschlüsselung (bcrypt)

## Technologie-Stack Implementierung

### **PHP** 
- **Framework:** Laravel 12.17.0
- **Kern-Anwendungslogik:**
  - `app/Models/User.php` - Benutzer-Datenmodell mit Rollensystem
  - `app/Livewire/Auth/Login.php` - Anmelde-Authentifizierungslogik
  - `app/Livewire/Auth/Logout.php` - Abmelde-Funktionalität  
  - `app/Livewire/Dashboard.php` - Dashboard-Controller-Logik
  - `app/Livewire/Admin/UserManagement.php` - CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
  - `app/Http/Middleware/AdminMiddleware.php` - Rollenbasierte Zugriffskontrolle
- **Konfiguration:** `config/`, `bootstrap/app.php`, `routes/web.php`
- **Datenbankintegration:** `database/migrations/`, `database/seeders/`
- **Framework-Dateien:** Durchgehend in Laravel-Struktur

### **HTML**
- **Blade-Templates** (Laravels Template-Engine - kompiliert zu HTML):
  - `resources/views/layouts/app.blade.php` - Haupt-HTML-Struktur mit Navigation
  - `resources/views/livewire/auth/login.blade.php` - Anmeldeformular HTML
  - `resources/views/livewire/auth/logout.blade.php` - Abmelde-Button HTML
  - `resources/views/livewire/dashboard.blade.php` - Dashboard-Seite HTML
  - `resources/views/livewire/admin/user-management.blade.php` - Benutzerverwaltungs-Interface HTML
- **Features:** Formulare, Tabellen, Navigation, responsives Layout
- **HTML5-Elemente:** `<form>`, `<table>`, `<input>`, `<button>`, `<nav>`, etc.

### **CSS**
- **Ort:** Eingebettet in `resources/views/layouts/app.blade.php` innerhalb von `<style>`-Tags
- **Implementierte Features:**
  - Responsives Grid-Layout und Navigation
  - Formular-Styling mit Validierungszuständen
  - Tabellen-Styling mit alternierenden Zeilen
  - Button-Stile (primär, Gefahr, Warnung)
  - Alert/Nachrichten-Styling (Erfolg, Fehler)
  - Professionelles Farbschema und Typografie
- **CSS-Klassen:** `.container`, `.btn`, `.form-group`, `.table`, `.alert`, etc.
- **Hinweis:** Eingebettet für Einfachheit und eigenständige Bereitstellung

### **JavaScript**
- **Primär:** Livewire 3.6.3 (behandelt alle reaktive Funktionalität automatisch)
  - Formular-Übertragungen ohne Seitenerneuerung
  - Echtzeit-Suchfilterung
  - Dynamische Inhalts-Updates
  - Komponenten-Zustandsverwaltung
- **Livewire JS-Integration:**
  - `@livewireStyles` und `@livewireScripts` im Layout
  - `wire:model` für bidirektionale Datenbindung
  - `wire:click` für Button-Interaktionen
  - `wire:submit` für Formular-Behandlung
  - `wire:confirm` für Löschbestätigungen
- **Generiertes JavaScript:** Livewire erstellt automatisch erforderliches JS für Reaktivität

### **MariaDB/MySQL Datenbank**
- **Datenbank-Dump:** `user_management_database.sql` (vollständige Datenbank mit Testdaten)
- **Schema-Definition:** 
  - `database/migrations/2014_10_12_000000_create_users_table.php` - Basis-Benutzer-Tabelle
  - `database/migrations/2025_06_05_175246_add_role_to_users_table.php` - Rollensystem
- **Testdaten:** `database/seeders/AdminUserSeeder.php` - Erstellt Admin- und Testbenutzer
- **Konfiguration:** `.env`-Datei (Datenbankverbindungseinstellungen)
- **Tabellen:**
  - `users` - Haupt-Benutzerdaten mit Rollen
  - `migrations` - Laravels Schema-Versionsverfolgung
  - `sessions` - Benutzer-Session-Verwaltung

### **Laravel Framework-Integration**
- **Vollständiges Framework:** Laravel 12.17.0 mit allen Komponenten
- **Verwendete Schlüssel-Framework-Features:**
  - **Eloquent ORM:** Datenbankinteraktionen (SQL-Injection-Prävention)
  - **Blade-Templating:** HTML-Generierung (XSS-Prävention)
  - **Middleware:** Request-Filterung und rollenbasierter Zugriff
  - **Validierung:** Input-Validierung und Fehlerbehandlung
  - **Authentifizierung:** Session-Verwaltung und Anmeldesystem
  - **Routing:** URL-Behandlung und Schutz
  - **Artisan CLI:** Datenbank-Migrationen und Anwendungsverwaltung
- **Abhängigkeiten:** `composer.json` - Alle PHP-Pakete und Framework-Komponenten

## Schnelle Installationsanweisungen

### 1. Datenbank-Setup
```bash
# Datenbank erstellen
mysql -u root -p
CREATE DATABASE user_management;
EXIT;

# Datenbank-Dump importieren
mysql -u root -p user_management < user_management_database.sql
```

### 2. Anwendungs-Setup  
```bash
# PHP-Abhängigkeiten installieren
composer install

# Umgebung konfigurieren
cp .env.example .env
# .env mit Ihren Datenbank-Zugangsdaten bearbeiten:
# DB_DATABASE=user_management
# DB_USERNAME=root
# DB_PASSWORD=ihr_passwort

# Anwendungsschlüssel generieren
php artisan key:generate

# Entwicklungsserver starten
php artisan serve
```

### 3. Anwendung zugreifen
- URL: http://localhost:8000
- **Admin-Konto:** Benutzername: `admin`, Passwort: `Admin123!`
- **Benutzer-Konto:** Benutzername: `testuser`, Passwort: `User123!`

## Aufgaben-Anforderungen Verifizierung

### **Erforderliche Technologien** ✅
| Anforderung | Implementierung | Ort |
|-------------|----------------|-----|
| **PHP** | Laravel 12 + Benutzerdefinierte Logik | `app/`, `config/`, `database/`, `routes/` |
| **JavaScript** | Livewire (reaktives Framework) | Eingebettet in Blade-Templates, automatische Generierung |
| **HTML** | Blade-Templates | `resources/views/` (kompiliert zu HTML) |
| **CSS** | Benutzerdefiniertes Stylesheet | `resources/views/layouts/app.blade.php` |
| **MariaDB** | Datenbank + Migrationen | `user_management_database.sql`, `database/migrations/` |
| **Framework** | Laravel + Livewire | Vollständige Anwendungsstruktur |

### **Erforderliche Features** ✅
| Feature | Datei-Ort | Verwendete Technologie |
|---------|-----------|------------------------|
| **Anmelde-Maske (Benutzername/Passwort)** | `resources/views/livewire/auth/login.blade.php` | HTML-Formulare + PHP-Validierung |
| **Startseite mit Abmeldung** | `resources/views/livewire/dashboard.blade.php` | HTML + CSS + JavaScript (Livewire) |
| **Admin-Benutzerverwaltung** | `resources/views/livewire/admin/user-management.blade.php` | Full-Stack-Integration |
| **Benutzer-Auflistung Tabelle** | Benutzerverwaltungs-Ansicht | HTML-Tabellen + CSS-Styling |
| **Benutzer bearbeiten (Benutzername/Passwort/Rolle)** | `app/Livewire/Admin/UserManagement.php` | PHP + HTML-Formulare + MariaDB |
| **Neue Benutzer erstellen** | Gleiche Komponente | PHP-Validierung + MariaDB INSERT |
| **Benutzer löschen** | Gleiche Komponente | PHP + JavaScript-Bestätigung + MariaDB DELETE |

### **Sicherheitsanforderungen** ✅
| Sicherheitsfeature | Implementierung | Dateien |
|-------------------|----------------|---------|
| **SQL-Injection-Prävention** | Eloquent ORM | `app/Livewire/Admin/UserManagement.php` |
| **XSS-Prävention** | Blade-Templating | Alle `.blade.php`-Dateien |
| **CSRF-Schutz** | Laravel + Livewire | Automatisch in allen Formularen |

## Datei-Struktur
```
user_management_system/
├── app/
│   ├── Http/Middleware/AdminMiddleware.php     # Rollenbasierte Zugriffskontrolle
│   ├── Livewire/                              # Interaktive Komponenten
│   │   ├── Auth/Login.php                      # Anmeldesystem
│   │   ├── Auth/Logout.php                     # Abmeldesystem
│   │   ├── Dashboard.php                       # Startseite
│   │   └── Admin/UserManagement.php            # CRUD-Operationen
│   └── Models/User.php                         # Benutzermodell mit Rollen
├── resources/views/                            # Benutzeroberflächen-Templates
│   ├── layouts/app.blade.php                   # Haupt-Layout
│   └── livewire/                              # Komponenten-Ansichten
├── database/
│   ├── migrations/                             # Datenbank-Schema-Änderungen
│   └── seeders/AdminUserSeeder.php            # Testdaten-Generator
├── routes/web.php                              # URL-Routing und Schutz
├── bootstrap/app.php                           # App-Konfiguration & Middleware
├── config/                                     # Laravel-Konfigurationsdateien
├── public/                                     # Webserver-Dokumentenstamm
├── storage/                                    # Logs, Cache, Datei-Uploads
├── artisan                                     # Laravel-Kommandozeilen-Tool
├── composer.json                               # PHP-Abhängigkeiten
├── .env.example                               # Umgebungs-Template
├── user_management_database.sql               # Vollständiger Datenbank-Dump
├── README.md                    # Setup-Anweisungen (Englisch)
├── README_DE.md                 # Setup-Anweisungen (Deutsch)  
├── SECURITY.md                  # Sicherheitsdokumentation (Englisch)
├── SECURITY_DE.md               # Sicherheitsdokumentation (Deutsch)
```

## Code-Beispiele nach Technologie

### **PHP-Beispiele**
```php
// Benutzermodell mit Rollensystem (app/Models/User.php)
public function isAdmin() {
    return $this->role === 'admin';
}

// CRUD-Operationen (app/Livewire/Admin/UserManagement.php)
public function saveUser() {
    $this->validate();
    User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'role' => $this->role,
    ]);
}

// Middleware-Sicherheit (app/Http/Middleware/AdminMiddleware.php)
public function handle(Request $request, Closure $next): Response {
    if (!auth()->check() || !auth()->user()->isAdmin()) {
        abort(403, 'Zugriff verweigert');
    }
    return $next($request);
}
```

### **HTML-Beispiele**
```html
<!-- Anmeldeformular (resources/views/livewire/auth/login.blade.php) -->
<form wire:submit="login">
    <div class="form-group">
        <label for="username">Benutzername:</label>
        <input type="text" id="username" wire:model="username" required>
    </div>
    <button type="submit" class="btn">Anmelden</button>
</form>

<!-- Benutzerverwaltungs-Tabelle (resources/views/livewire/admin/user-management.blade.php) -->
<table class="table">
    <thead>
        <tr>
            <th>Benutzername</th>
            <th>E-Mail</th>
            <th>Rolle</th>
            <th>Aktionen</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
```

### **JavaScript/Livewire-Beispiele**
```html
<!-- Echtzeit-Suche -->
<input type="text" wire:model.live="search" placeholder="Benutzer suchen...">

<!-- Interaktive Buttons -->
<button wire:click="editUser({{ $user->id }})">Bearbeiten</button>
<button wire:click="deleteUser({{ $user->id }})" wire:confirm="Sind Sie sicher?">Löschen</button>
```

## Testen der Anwendung
1. **Anmeldesystem:** Testen Sie sowohl Admin- als auch Benutzerkonten
2. **Rollenschutz:** Benutzerkonto kann nicht auf Admin-Features zugreifen
3. **CRUD-Operationen:** Erstellen, bearbeiten, löschen Sie Benutzer als Admin
4. **Suchfunktion:** Filtern Sie Benutzer nach Name oder E-Mail
5. **Validierung:** Versuchen Sie, Benutzer mit schwachen Passwörtern zu erstellen
6. **Sicherheit:** Versuchen Sie, als normaler Benutzer auf Admin-URLs zuzugreifen

## Zusammenfassung

Dieses Benutzerverwaltungssystem demonstriert Kompetenz in allen angeforderten Technologien:

- **✅ PHP:** Objektorientierte Programmierung, Laravel-Framework, Sicherheitsimplementierung
- **✅ HTML:** Semantisches Markup, Formulare, Tabellen, responsives Layout  
- **✅ CSS:** Professionelles Styling, responsives Design, komponentenbasierte Klassen
- **✅ JavaScript:** Moderne reaktive Benutzeroberfläche mit Livewire-Framework
- **✅ MariaDB:** Datenbankdesign, Migrationen, Beziehungen, sichere Abfragen
- **✅ Framework:** Laravel 12 mit Livewire für Full-Stack-Entwicklung

Die Anwendung folgt Industriestandards für Sicherheit, Wartbarkeit und Benutzererfahrung und erfüllt dabei alle spezifizierten Anforderungen.

## Entwicklungshinweise
- Erstellt mit modernen Laravel 12-Mustern und -Konventionen
- Vollständig responsives Design, das auf Desktop und Mobilgeräten funktioniert
- Produktionsreife Sicherheitsimplementierungen (OWASP-konform)
- Umfassende Input-Validierung und Fehlerbehandlung
- Professionelle Code-Organisation nach MVC-Architektur
- Eigenständige Anwendung mit eingebetteten Stilen für einfache Bereitstellung
