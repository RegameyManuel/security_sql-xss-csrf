Les bases de données `'mysql'`, `'information_schema'`, `'sys'`, et `'performance_schema'` jouent des rôles cruciaux dans MySQL et MariaDB, fournissant des informations sur la structure, la performance, et la sécurité de votre système de base de données. Voici une présentation de chaque base de données et leur utilité potentielle dans un cadre de cybersécurité :

### `mysql`

La base de données `mysql` contient des informations essentielles sur les privilèges des utilisateurs, les comptes, et d'autres méta-données de sécurité. Elle est fondamentale pour gérer l'authentification et l'autorisation des utilisateurs.

- **Cybersécurité** : En examinant les privilèges des utilisateurs dans cette base de données, vous pouvez identifier les comptes ayant des accès excessifs et potentiellement dangereux. Réviser régulièrement ces privilèges permet de minimiser les risques de failles de sécurité en appliquant le principe du moindre privilège.

### `information_schema`

La base de données `information_schema` fournit une vue en lecture seule de la structure de toutes les bases de données dans le système, incluant les tables, colonnes, schémas, et bien plus.

- **Cybersécurité** : Elle peut être utilisée pour effectuer des audits de structure et s'assurer que les configurations de la base de données correspondent aux meilleures pratiques de sécurité. Par exemple, vérifier que les données sensibles sont correctement typées et stockées.

### `sys`

La base de données `sys` est une collection de vues, fonctions, et procédures stockées qui aident à interpréter les données de performance collectées par la base de données `performance_schema`. Elle simplifie l'analyse des performances et la détection de problèmes.

- **Cybersécurité** : Bien qu'elle soit principalement orientée vers la performance, `sys` peut aider à identifier des comportements anormaux ou des requêtes inhabituelles qui pourraient indiquer une tentative d'intrusion ou une mauvaise configuration affectant la sécurité.

### `performance_schema`

La base de données `performance_schema` collecte et fournit des informations détaillées sur la performance du serveur de base de données, y compris des statistiques sur les requêtes, les threads, les événements, et plus.

- **Cybersécurité** : `performance_schema` permet de surveiller les performances en temps réel et d'identifier les anomalies ou les changements de comportement dans l'utilisation de la base de données, qui peuvent être des signes d'activités malveillantes. Analyser ces informations peut aider à détecter des tentatives de SQL Injection, des accès non autorisés, ou des exfiltrations de données.

Dans un cadre de cybersécurité, l'accès et l'analyse de ces bases de données permettent d'effectuer des audits de sécurité complets, d'identifier les configurations à risque, de surveiller les performances pour détecter les comportements suspects, et de gérer efficacement les privilèges des utilisateurs. Il est essentiel de les protéger et de limiter strictement l'accès à ces bases de données pour prévenir les abus et les fuites d'informations sensibles.






1. **Voir la structure (noms des colonnes et types de données) de toutes vos tables personnalisées ou tierces, sans inclure les détails des tables internes utilisées par le système de gestion de base de données lui-même.** :

   ```sql
    SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, DATA_TYPE 
    FROM information_schema.COLUMNS 
    WHERE TABLE_SCHEMA NOT IN ('mysql', 'information_schema', 'sys', 'performance_schema');
   ```

    Cette requête SQL récupère et affiche des informations sur les colonnes des tables présentes dans votre base de données MySQL ou MariaDB, à l'exception de celles   appartenant aux bases de données système comme `mysql`, `information_schema`, `sys`, et `performance_schema`. Plus précisément, elle liste le nom de la base de données   (`TABLE_SCHEMA`), le nom de la table (`TABLE_NAME`), le nom de la colonne (`COLUMN_NAME`), et le type de données de chaque colonne (`DATA_TYPE`), mais seulement pour     les bases de données créées par l'utilisateur ou tierces, en excluant les bases de données internes utilisées par MySQL/MariaDB pour sa gestion interne.

    En d'autres termes, cette requête vous permet de voir la structure (noms des colonnes et types de données) de toutes vos tables personnalisées ou tierces, sans inclure     les détails des tables internes utilisées par le système de gestion de base de données lui-même.


2. **Lister toutes les tables (sans détail des colonnes) hors des bases de données système** :

   ```sql
   SELECT TABLE_SCHEMA, TABLE_NAME 
   FROM information_schema.TABLES 
   WHERE TABLE_SCHEMA NOT IN ('mysql', 'information_schema', 'sys', 'performance_schema');
   ```

   Cette requête est plus simple si vous voulez seulement connaître les noms des tables et de quelles bases de données elles viennent, sans entrer dans le détail des colonnes.

3. **Obtenir des informations détaillées sur les contraintes de clé étrangère** :

   ```sql
   SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
   FROM information_schema.KEY_COLUMN_USAGE
   WHERE REFERENCED_TABLE_SCHEMA IS NOT NULL
     AND TABLE_SCHEMA NOT IN ('mysql', 'information_schema', 'sys', 'performance_schema');
   ```

   Cette alternative serait utile si vous êtes intéressé par la façon dont les tables sont liées entre elles plutôt que par la structure détaillée des colonnes.

4. **Filtrer pour une base de données spécifique** :

   Si vous êtes intéressé par une base de données spécifique (par exemple, `ma_base_de_donnees`), vous pourriez simplifier ou modifier la requête pour cibler uniquement cette base :

   ```sql
   SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE 
   FROM information_schema.COLUMNS 
   WHERE TABLE_SCHEMA = 'ma_base_de_donnees';
   ```

   Cette version se concentre uniquement sur la structure d'une base de données que vous choisissez, ce qui pourrait être plus pertinent pour des cas d'utilisation spécifiques.




### Lister Tous les Utilisateurs et Leurs Droits

Pour lister tous les utilisateurs et leurs droits, vous pouvez interroger la table `mysql.user`. Cette table contient des informations sur tous les utilisateurs et leurs privilèges au niveau global. Pour une vue simplifiée des utilisateurs et de leurs privilèges principaux :

```sql
SELECT User, Host, Select_priv, Insert_priv, Update_priv, Delete_priv, Execute_priv, Grant_priv 
FROM mysql.user;
```

Cette requête vous donnera une liste des utilisateurs et un aperçu de leurs privilèges principaux (sélection, insertion, mise à jour, suppression, exécution, droit de donner des privilèges).

### Lister les Procédures Stockées et les Triggers

Pour lister les procédures stockées et les triggers, vous pouvez utiliser les tables `information_schema.ROUTINES` pour les procédures et fonctions, et `information_schema.TRIGGERS` pour les triggers.

- **Procédures stockées et fonctions** :

  ```sql
  SELECT ROUTINE_SCHEMA, ROUTINE_NAME, ROUTINE_TYPE
  FROM information_schema.ROUTINES
  WHERE ROUTINE_SCHEMA NOT IN ('mysql', 'information_schema', 'sys', 'performance_schema');
  ```

  Cette requête liste les noms et les types (PROCEDURE ou FUNCTION) des routines (procédures stockées et fonctions), en excluant les bases de données système.

- **Triggers** :

  ```sql
  SELECT TRIGGER_SCHEMA, TRIGGER_NAME, EVENT_OBJECT_TABLE, ACTION_TIMING, EVENT_MANIPULATION
  FROM information_schema.TRIGGERS
  WHERE TRIGGER_SCHEMA NOT IN ('mysql', 'information_schema', 'sys', 'performance_schema');
  ```

  Cette requête fournit des détails sur les triggers, y compris le schéma dans lequel ils se trouvent, le nom du trigger, la table sur laquelle ils opèrent, quand ils s'activent (`BEFORE` ou `AFTER`), et le type d'événement qui les déclenche (`INSERT`, `UPDATE`, `DELETE`).

