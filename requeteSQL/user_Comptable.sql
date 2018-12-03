-- Ce script permet d'ajouter un utilisateur "Comptable" pour la validation et le suivi des fiches de frais

USE gsb_frais;

CREATE TABLE IF NOT EXISTS comptable (
  id char(2) NOT NULL,
  nom char(30) DEFAULT NULL,
  prenom char(30) DEFAULT NULL,
  login char(20) DEFAULT NULL,
  mdp char(20) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;


INSERT INTO comptable VALUES 
('c1','Leclercq','Alexandre','alexlecq','admin1234');

