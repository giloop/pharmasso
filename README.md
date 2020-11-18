# Pharmasso

*Et si on gapspillait un peu moins de médicaments.*

Site pour mutualiser des médicaments non utilisés. Parce qu'on a souvent les 
mêmes maladies, les mêmes ordonnances, et une pharmacopée qui n'attend que sa péremption dans nos placards.

## Pourquoi?

Pour aider un peu la sécu, et moins gaspiller en général.  

## Qu'est-ce que c'est ?

Il s'agit d'un site simple en php pour  indiquer les médicaments que l'on a en stock chez nous et qui ne nous servirons probablement pas. 

## Mode d'emploi / Installation

- Choisir la branche `mysql-php5-free` : la branche `master` ne contient que des fichiers de test et des fichiers de ANSM.
- Créer une base mysql, à l'aide du code ci-dessous (valable pour un site free.fr)
- Ajouter les infos de connexion dans le fichier infos_bd.php (utiliser / renommer infos_bd.example.php)
- Uploader l'ensemble dans un répertoire sur votre site. 
- Comme il n'y a pas de compte utilisateur, il est recommandé de limiter l'accès au répertoire pour éviter les saisies indésirables (voir .htaccess.example)  

```sql
--
-- Structure de la table `ph_medocs`
--

DROP TABLE IF EXISTS `ph_medocs`;
CREATE TABLE IF NOT EXISTS "ph_medocs" (
  "id" int(11) NOT NULL auto_increment,
  "nom" varchar(400) collate latin1_general_ci NOT NULL,
  "posologie" varchar(64) collate latin1_general_ci default NULL,
  PRIMARY KEY  ("id")
);

--
-- Structure de la table `ph_pharmacie`
--

DROP TABLE IF EXISTS `ph_pharmacie`;
CREATE TABLE IF NOT EXISTS "ph_pharmacie" (
  "id" int(11) NOT NULL auto_increment,
  "userId" int(11) NOT NULL,
  "medocId" int(11) NOT NULL,
  "quantite" varchar(64) collate latin1_general_ci NOT NULL,
  "datePeremption" varchar(10) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  ("id")
);

--
-- Structure de la table `ph_users`
--

DROP TABLE IF EXISTS `ph_users`;
CREATE TABLE IF NOT EXISTS "ph_users" (
  "id" int(11) NOT NULL auto_increment,
  "nom" varchar(64) collate latin1_general_ci NOT NULL,
  "tel" varchar(10) collate latin1_general_ci default NULL,
  "mail" varchar(64) collate latin1_general_ci default NULL,
  PRIMARY KEY  ("id"),
  UNIQUE KEY "nom" ("nom")
);
```
