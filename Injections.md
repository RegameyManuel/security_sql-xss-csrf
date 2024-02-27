La sécurité des applications web est une préoccupation majeure pour les développeurs, en particulier en ce qui concerne la prévention des injections SQL, une technique d'attaque où des intrus exploitent des vulnérabilités dans l'interaction d'une application avec sa base de données. Ces attaques peuvent avoir des conséquences désastreuses, allant de la suppression de données à la fuite d'informations confidentielles. Voici une synthèse organisée des exemples d'injections SQL fournis précédemment, démontrant diverses façons dont ces attaques peuvent être menées et comment les prévenir.

### Exemples d'Attaques par Injection SQL

1. **Suppression de Données** :
   - Via un formulaire d'inscription, un attaquant injecte `', ''); DROP TABLE article; --`, causant la suppression de la table `article` et la perte de tous les articles.

```sql
INSERT INTO utilisateur (nom, mot_de_passe) VALUES ('nom_utilisateur', 'mot_de_passe');
```

Un attaquant pourrait soumettre un nom d'utilisateur spécialement conçu pour exécuter une injection SQL. Si l'application insère directement les valeurs soumises sans les échapper ou les valider, l'attaquant pourrait utiliser la saisie suivante :

```
nom_utilisateur', ''); DROP TABLE article; --
```

En insérant cette entrée dans le formulaire, la requête SQL finale exécutée par le serveur pourrait ressembler à cela :

```sql
INSERT INTO utilisateur (nom, mot_de_passe) VALUES ('nom_utilisateur', ''); DROP TABLE article; --', 'mot_de_passe');
```

2. **By-pass d'Authentification** :
   - Un attaquant soumet `' OR '1'='1` dans un champ de nom d'utilisateur, modifiant la logique de la requête SQL pour se connecter sans mot de passe valide.

Imaginons une page de connexion où l'utilisateur soumet un nom d'utilisateur et un mot de passe, qui sont insérés dans une requête SQL directement sans validation ni utilisation de requêtes préparées. Un attaquant pourrait entrer une valeur spéciale dans le champ du nom d'utilisateur pour by-passer l'authentification :

```sql
' OR '1'='1
```

Si l'application construit la requête SQL comme suit :

```sql
SELECT * FROM utilisateur WHERE nom = 'entrée_utilisateur' AND mot_de_passe = 'entrée_mot_de_passe';
```

En remplaçant `entrée_utilisateur` par l'injection ci-dessus, la requête deviendrait :

```sql
SELECT * FROM utilisateur WHERE nom = '' OR '1'='1' AND mot_de_passe = 'entrée_mot_de_passe';
```

Cette condition sera toujours vraie (`'1'='1'`), permettant potentiellement à un attaquant d'accéder sans connaître un mot de passe valide.

3. **Modification de Données** :

   - Injection dans un champ d'adresse e-mail: `', mot_de_passe = 'piraté' WHERE id = '1' OR '1'='1`, permettant à un attaquant de changer les mots de passe de tous les utilisateurs.

   Supposons qu'il existe une fonctionnalité permettant à un utilisateur de mettre à jour son profil, y compris son adresse e-mail. Un attaquant pourrait injecter une requête SQL dans le champ de l'adresse e-mail pour modifier non seulement son adresse mais aussi celle d'autres utilisateurs :

```sql
', mot_de_passe = 'piraté' WHERE id = '1' OR '1'='1
```

Si cette entrée est insérée dans une requête non sécurisée, cela pourrait potentiellement réinitialiser les mots de passe de tous les comptes.

4. **Extraction d'Informations** :

   - Modification d'un paramètre d'URL en `1 UNION SELECT nom, mot_de_passe FROM utilisateur`, exposant les noms et mots de passe des utilisateurs.

   Un attaquant peut exploiter une injection SQL pour extraire des informations sensibles de la base de données. Par exemple, si un site affiche des articles basés sur un paramètre d'URL, un attaquant pourrait modifier l'URL pour exécuter une requête qui révèle des informations sensibles :

```sql
1 UNION SELECT nom, mot_de_passe FROM utilisateur
```

Si le paramètre est directement inséré dans une requête SQL, cela pourrait amener l'application à afficher les noms et mots de passe de tous les utilisateurs.

### Prévention des Injections SQL

Pour contrer ces vulnérabilités, il est essentiel d'adopter des pratiques de codage sécurisées :

- **Utiliser des Requêtes Préparées** : Elles séparent le code SQL de la donnée, empêchant l'interprétation des entrées utilisateur comme du code SQL.
- **Employer des ORM (Object Relational Mapping)** : Les ORM aident à générer du code SQL sécurisé automatiquement, réduisant le risque d'injection.
- **Valider et Nettoyer les Entrées Utilisateur** : S'assurer que toutes les entrées correspondent aux attentes en termes de type et de format avant de les traiter.
- **Utiliser des Comptes de Base de Données à Privilèges Limités** : En limitant les actions que peut effectuer l'utilisateur de la base de données, on réduit l'impact potentiel d'une injection réussie.

Ces stratégies forment un bouclier contre les injections SQL, protégeant ainsi les applications web des intrusions malveillantes. Il est crucial que les développeurs soient formés à ces pratiques pour sécuriser efficacement leurs applications dès la conception.
