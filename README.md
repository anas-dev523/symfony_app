# Devoir Symfony – Défis solidaires

## Lancer le projet

1. Installer les dépendances : `composer install`
2. Configurer la base de données dans `.env` (`DATABASE_URL=...`)
3. Exécuter les migrations : `php bin/console doctrine:migrations:migrate`
4. Charger les fixtures (admin + utilisateur de test) : `php bin/console doctrine:fixtures:load`
5. Démarrer le serveur : `symfony server:start` (ou `php -S 127.0.0.1:8000 -t public`)

Comptes de test générés :

| Email           | Mot de passe | Rôle        |
|-----------------|--------------|-------------|
| admin@demo.com  | admin123     | ROLE_ADMIN  |
| user@demo.com   | user123      | ROLE_USER   |

## Routes principales

| Méthode | Route                               | Description                                         | Accès          |
|---------|--------------------------------------|-----------------------------------------------------|----------------|
| GET     | `/`                                  | Défi aléatoire pour l’accueil                       | Visiteur       |
| GET     | `/defis`                             | Liste complète des défis                            | Visiteur       |
| GET/POST| `/defi/nouveau`                      | Création d’un défi                                  | ROLE_USER      |
| GET     | `/defi/{id}/retours`                 | Retours d’expérience d’un défi                      | Visiteur       |
| GET/POST| `/defi/{id}/retour/nouveau`          | Partager un retour                                  | ROLE_USER      |
| GET/POST| `/defi/{id}/aide/nouvelle`           | Demander de l’aide sur un défi                      | ROLE_USER      |
| GET     | `/api/defi/aleatoire`                | API JSON défi aléatoire                             | Visiteur       |
| GET     | `/admin`                             | Tableau de bord admin                               | ROLE_ADMIN     |
| GET     | `/admin/defis`                       | Liste + actions (valider / supprimer) sur défis     | ROLE_ADMIN     |
| POST    | `/admin/defi/{id}/valider`           | Valider un défi                                     | ROLE_ADMIN     |
| POST    | `/admin/defi/{id}/supprimer`         | Supprimer un défi                                   | ROLE_ADMIN     |
| GET     | `/admin/retours`                     | Liste des retours                                   | ROLE_ADMIN     |
| POST    | `/admin/retour/{id}/supprimer`       | Supprimer un retour                                 | ROLE_ADMIN     |
| GET     | `/admin/utilisateurs`                | Liste des profils utilisateurs                      | ROLE_ADMIN     |
| GET/POST| `/login`                             | Authentification                                    | Visiteur       |
| GET     | `/logout`                            | Déconnexion                                         | Authentifié    |

## Notes

- Les formulaires `DefiType`, `RetourExperienceType` et `DemandeAideType` sont validés côté serveur avec des contraintes `Assert`.
- Les routes sensibles sont protégées via `security.yaml` (ROLE_USER / ROLE_ADMIN) et les actions critiques utilisent des tokens CSRF.
- L’en-tête commun (`templates/base.html.twig`) fournit une navigation rapide, l’affichage des flash messages et charge Bootstrap 5 pour un rendu cohérent.

