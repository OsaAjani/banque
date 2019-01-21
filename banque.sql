-- 
-- Données SQL pour l'installatio initiale
-- 
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(330) NOT NULL,
  `motdepasse` varchar(330) NOT NULL,
  `solde` int(11) NOT NULL,
  `role` varchar(330) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

INSERT INTO `utilisateurs` VALUES 
  (1,'gerant','MDPGERANT',1000000,'admin'),
  (2,'karim','azerty',1000,'client'),
  (3,'leila','leila123',3000,'client')
;

update utilisateurs set motdepasse = conv(floor(rand() * 99999999999999), 20, 36) WHERE id = 1;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expediteur` int(11) NOT NULL,
  `contenu` varchar(330) NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;


INSERT INTO `messages` VALUES 
  (1,3,'Bonjour, Avez vous bien reçu mon chèque? Cordialement, Leila'),
  (2,3,'Bonjour, C est bizarre, il manque 100€ sur mon compte.  Cordialement, Leila'),
  (3,2,'Merci pour tout. Karim.')
;