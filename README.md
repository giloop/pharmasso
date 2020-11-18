# Pharmasso
*Et si on gapspillait un peu moins de médicaments.*

Site pour mutualiser des médicaments non utilisés. Parce qu'on a souvent les 
mêmes maladies, les mêmes ordonnances, et une pharmacopée qui n'attend que sa péremption dans nos placards.

## Pourquoi?
Pour aider un peu la sécu, et moins gaspiller en général.  

## Qu'est-ce que c'est ?
Il s'agit d'un site simple en php pour  indiquer les médicaments que l'on a en stock chez nous et qui ne nous servirons probablement pas. 

## Mode d'emploi / Installation
- Créer une base mysql, à l'aide du code ci-dessous (valable pour un site free.fr)
- Ajouter les infos de connexion dans le fichier infos_bd.php (utiliser / renommer infos_bd.example.php)
- Uploader l'ensemble dans un répertoire sur votre site. 
- Comme il n'y a pas de compte utilisateur, il est recommandé de limiter l'accès au répertoire pour éviter les saisies indésirables (voir .htaccess.example)  
- Le code ci-dessous sert à créer les tables
- Vous pouvez également importer le fichier `db_sample.sql` dans votre base de données pour tester le code avec des valeurs


```sql
--
-- Structure de la table `ph_medocs`
--

DROP TABLE IF EXISTS `ph_medocs`;
CREATE TABLE `ph_medocs` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `nom` VARCHAR(400) NOT NULL , 
  `posologie` VARCHAR(64) NOT NULL , PRIMARY KEY (`id`)
  ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci; 

--
-- Structure de la table `ph_pharmacie`
--

DROP TABLE IF EXISTS `ph_pharmacie`;
CREATE TABLE IF NOT EXISTS `ph_pharmacie` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL,
  `medocId` int(11) NOT NULL,
  `quantite` varchar(64) NOT NULL,
  `datePeremption` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci; 

--
-- Structure de la table `ph_users`
--

DROP TABLE IF EXISTS `ph_users`;
CREATE TABLE IF NOT EXISTS `ph_users` (
  `id` int(11) NOT NULL auto_increment,
  `nom` varchar(64) NOT NULL,
  `tel` varchar(10) NULL,
  `mail` varchar(64) NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci; 

```
