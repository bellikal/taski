<!-- Deutsch -->

# Taski

## Beschreibung

Taski ist eine einfache Aufgabenverwaltungsanwendung, entwickelt mit Laravel. Sie ermöglicht es Benutzern, Tasks zu verschiedenen Kategorien wie Haushalt, Persönlich, Arbeit oder Familie zu erstellen, zu bearbeiten und zu löschen. Tasks können mit Fälligkeitsdaten versehen und kommentiert werden. Über das Dashboard können auch Tasks anderer Benutzer eingesehen werden. Taski ist mein erstes Laravel-Projekt und dient als Grundlage für zukünftige Erweiterungen und Verbesserungen.

## Hauptfunktionalitäten

- Erstellen, Bearbeiten und Löschen von Tasks.
- Zuordnung von Tasks zu Kategorien (Haushalt, Persönlich, Arbeit, Familie).
- Festlegung von Fälligkeitsdaten für Tasks.
- Kommentieren von Tasks.
- Dashboard zur Ansicht von Tasks anderer Benutzer.

## Installation und Einrichtung

Führen Sie die folgenden Schritte aus, um Taski einzurichten:

1. Klonen Sie das Repository:
git clone https://github.com/IhrBenutzername/Taski.git

2. Wechseln Sie in das Projektverzeichnis:
cd Taski

3. Installieren Sie die Abhängigkeiten:
composer install

4. Kopieren Sie die `.env.example`-Datei zu `.env` und konfigurieren Sie Ihre Datenbankinformationen:
cp .env.example .env

5. Generieren Sie einen App-Schlüssel:
php artisan key:generate

6. Führen Sie die Migrationen aus, um die Datenbanktabellen zu erstellen:
php artisan migrate

7. (Optional) Führen Sie Seeders aus, um Ihre Datenbank mit Beispieldaten zu füllen:
php artisan db:seed

8. Starten Sie den Laravel-Entwicklungsserver:
php artisan serve


Besuchen Sie `http://localhost:8000` in Ihrem Browser, um die Anwendung zu nutzen.

## Verwendung

Taski ist intuitiv und selbsterklärend. Beginnen Sie direkt nach der Einrichtung mit dem Erstellen, Bearbeiten und Kommentieren von Tasks sowie der Nutzung des Dashboards.

## Mitwirkende

Derzeit bin ich, der einzige Entwickler dieses Projekts. Ich plane, Taski kontinuierlich zu erweitern und zu verbessern.

## Kontakt

Für Fragen, Anmerkungen oder Vorschläge können Sie mich gerne kontaktieren. 

belliz@me.com
https://bellikal.com

############################################################################

<!-- English -->

# Taski

## Description

Taski is a simple task management application developed with Laravel. It allows users to create, edit, and delete tasks assigned to various categories such as Household, Personal, Work, or Family. Tasks can be set with due dates and commented on. The dashboard also allows viewing tasks from other users. Taski is my first Laravel project and serves as a foundation for future expansions and improvements.

## Main Features

- Create, edit, and delete tasks.
- Assign tasks to categories (Household, Personal, Work, Family).
- Set due dates for tasks.
- Comment on tasks.
- Dashboard to view tasks from other users.

## Installation and Setup

Follow these steps to set up Taski:

1. Clone the repository:
git clone https://github.com/YourUsername/Taski.git

2. Change into the project directory:
cd Taski

3. Install dependencies:
composer install

4. Copy the `.env.example` file to `.env` and configure your database information:
cp .env.example .env

5. Generate an app key:
php artisan key:generate

6. Run migrations to create the database tables:
php artisan migrate

7. (Optional) Run seeders to fill your database with sample data:
php artisan db:seed

8. Start the Laravel development server:
php artisan serve


Visit `http://localhost:8000` in your browser to use the application.

## Usage

Taski is intuitive and self-explanatory. Start creating, editing, and commenting on tasks as well as using the dashboard right after setting it up.

## Contributors

Currently, I am the sole developer of this project. I plan to continuously expand and improve Taski.

## Contact

For questions, comments, or suggestions, please feel free to contact me.

belliz@me.com
https://bellikal.com
