## Livewire Example

This repository contains a little example of the CRUD creation in laravel with livewire and jetstream.

## Install project.

Follow the next steps for the project installing.

1. Using git client, clone the repository with the commmand:

```bash
git clone https://github.com/AndreyPootMay/livewire-example.git`
```

2. Create a database for this project in MySQL or MariaDB.

```sql
CREATE DATABASE `livewire_app` CHARACTER SET utf8 COLLATE utf8_general_ci;
```

3. Copy enviroment variables with the next command `cp .env.example .env` and open the file named `.env` and change the variables in it.

4. Now, you need to run the outstanding migrations of the database.

```bash
php artisan migrate
```

5. Then you need to run the database seeds.

```bash
php artisan db:seed
```

6. For css styles and assets registration you need to run a node package manager process:

```
npm run dev
```

## Credits

- [Coders Free](https://codersfree.com/) course instructor.
- [Livewire basic course playlist](https://www.youtube.com/playlist?list=PLZ2ovOgdI-kWqCet33O0WezN14KShkwER).
- [Livewire documentation](https://laravel-livewire.com/docs/2.x/quickstart)
- [Laravel documentation](https://laravel.com/docs/8.x/)