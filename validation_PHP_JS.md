Pour filtrer et valider les données d'un formulaire contenant nom, prénom, date de naissance, adresse, complément d'adresse, code postal (CP), ville, pays, téléphone, et mail, nous pouvons utiliser différentes techniques en PHP et JavaScript. Voici comment vous pouvez procéder :

### 1. Filtrage avec regex en PHP

En PHP, vous pouvez utiliser les expressions régulières (regex) pour valider les entrées. Voici un exemple pour chaque champ :

```php
// Nom, Prénom
if (preg_match('/^[a-zA-Z- ]+$/', $nom)) {
    // Valide
}

// Date de naissance (format YYYY-MM-DD)
if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateNaissance)) {
    // Valide
}

// Adresse, Complément d'adresse (exemple basique)
if (preg_match('/^[a-zA-Z0-9,.\- ]+$/', $adresse)) {
    // Valide
}

// Code Postal (exemple pour la France)
if (preg_match('/^\d{5}$/', $cp)) {
    // Valide
}

// Ville
if (preg_match('/^[a-zA-Z- ]+$/', $ville)) {
    // Valide
}

// Pays
if (preg_match('/^[a-zA-Z- ]+$/', $pays)) {
    // Valide
}

// Téléphone (format international +33 pour la France)
if (preg_match('/^\+33\d{9}$/', $telephone)) {
    // Valide
}

// Mail
if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $mail)) {
    // Valide
}
```

### 2. Filtrage avec fonctions POSIX en PHP

Les fonctions POSIX en PHP (identifiées par `ereg` et ses variantes) sont considérées comme obsolètes et ont été supprimées en PHP 7. Il est recommandé d'utiliser PCRE (preg_match et ses variantes) pour le filtrage et la validation des expressions régulières.

### 3. Filtrage avec fonctions PCRE en PHP

L'exemple donné ci-dessus pour le filtrage avec regex utilise déjà les fonctions PCRE (`preg_match`), qui sont la méthode recommandée en PHP pour travailler avec des expressions régulières.

### 4. Filtrage en JavaScript

En JavaScript, vous pouvez également utiliser des expressions régulières pour valider les données du côté client. Voici comment vous pouvez procéder :

```javascript
// Nom, Prénom
if (/^[a-zA-Z- ]+$/.test(nom)) {
    // Valide
}

// Date de naissance (format YYYY-MM-DD)
if (/^\d{4}-\d{2}-\d{2}$/.test(dateNaissance)) {
    // Valide
}

// Adresse, Complément d'adresse (exemple basique)
if (/^[a-zA-Z0-9,.\- ]+$/.test(adresse)) {
    // Valide
}

// Code Postal (exemple pour la France)
if (/^\d{5}$/.test(cp)) {
    // Valide
}

// Ville
if (/^[a-zA-Z- ]+$/.test(ville)) {
    // Valide
}

// Pays
if (/^[a-zA-Z- ]+$/.test(pays)) {
    // Valide
}

// Téléphone (format international +33 pour la France)
if (/^\+33\d{9}$/.test(telephone)) {
    // Valide
}

// Mail
if (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(mail)) {
    // Valide
}
```

Ces exemples montrent comment filtrer et valider des données à l'aide de regex en PHP et JavaScript. Adaptez les expressions régulières en fonction des besoins spécifiques de votre formulaire et des formats attendus pour chaque champ.
