INSERT INTO `categorie` (`id`, `categoria`, `tag`) VALUES
(1, 'varie', 'varie'),
(2, 'ufficio', 'ufficio'),
(3, 'cibo', 'cibo');

INSERT INTO `costi` (`id`, `costo`, `descrizione`, `idutente`, `tempo`) VALUES
(1, 10, 'gratta e vinci', 21, '2020-08-13'),
(2, 40, 'bilancia', 21, '2020-08-21'),
(3, 3000, 'computer', 21, '2020-08-21'),
(4, 20, 'cancelleria', 21, '2020-08-21'),
(5, 20, 'regalo', 20, '2020-08-21'),
(6, 40, 'toner', 20, '2020-08-21'),
(7, 60, 'maglietta', 21, '2020-08-21'),
(8, 20, 'pranzo', 21, '2020-08-21'),
(9, 40, 'pranzo', 20, '2020-08-21'),
(10, 3500, 'computer', 21, '2020-08-21'),
(11, 800, 'telefono', 21, '2020-08-21'),
(12, 10, 'lavanderia', 21, '2020-08-21'),
(13, 20, 'pranzo', 21, '2020-08-21'),
(14, 70, 'cena', 22, '2020-08-21'),
(15, 500, 'barca', 23, '2020-08-21'),
(16, 300, 'sedia', 24, '2020-08-21'),
(17, 60, 'staffa', 22, '2020-08-21');

INSERT INTO `costicategorie` (`costiid`, `categorieid`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 3),
(4, 1),
(5, 2),
(5, 3),
(6, 3),
(7, 1),
(8, 1),
(8, 2),
(9, 3),
(10, 1),
(11, 2),
(11, 3),
(12, 3),
(12, 1),
(13, 1),
(14, 2),
(15, 2),
(16, 1);

INSERT INTO `utenti` (`id`, `utente`, `mail`, `password`) VALUES
(20, 'daniele', 'daniele8808@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(21, 'ionela', 'iola86@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(22, 'amerigo', 'iola85@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'sauzz', 'iola82@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(24, 'mamma', 'iola84@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

INSERT INTO `ruoli`(`id`, `descrizione`) VALUES 
('amministratore', 'aggiungi, rimuovi, modifica utenti, spese e categorie'),
('dipendente', 'aggiungi, spese e categorie');

INSERT INTO `utentiruoli`(`utenteid`, `ruoloid`) VALUES 
(20,'amministratore'),
(20,'dipendente'),
(21,'dipendente'),
(22,'dipendente'),
(23,'dipendente'),
(24,'dipendente');