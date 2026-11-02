CREATE TABLE IF NOT EXISTS `regions` (
                                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                                         `name` VARCHAR(100) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `regions` (`name`) VALUES
                                   ('Hlavní město Praha'), ('Středočeský kraj'), ('Jihočeský kraj'), ('Plzeňský kraj'),
                                   ('Karlovarský kraj'), ('Ústecký kraj'), ('Liberecký kraj'), ('Královéhradecký kraj'),
                                   ('Pardubický kraj'), ('Kraj Vysočina'), ('Jihomoravský kraj'), ('Olomoucký kraj'),
                                   ('Zlínský kraj'), ('Moravskoslezský kraj');

CREATE TABLE IF NOT EXISTS `students` (
                                          `id` INT AUTO_INCREMENT PRIMARY KEY,
                                          `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `firstname` VARCHAR(50) NOT NULL,
    `surname` VARCHAR(50) NOT NULL,
    `street` VARCHAR(100) NOT NULL,
    `city` VARCHAR(100) NOT NULL,
    `zip` VARCHAR(10) NOT NULL,
    `region_id` INT NOT NULL,
    `gender` VARCHAR(10) NOT NULL,
    `note` TEXT,
    CONSTRAINT `fk_student_region` FOREIGN KEY (`region_id`) REFERENCES `regions`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `students` (`email`, `password`, `firstname`, `surname`, `street`, `city`, `zip`, `region_id`, `gender`, `note`) VALUES
                                                                                                                                 ('jan.novak@email.cz', 'heslo123', 'Jan', 'Novák', 'Hlavní 12', 'Ostrava', '70200', 14, 'muz', 'První testovací student'),
                                                                                                                                 ('petra.svobodova@email.cz', 'heslo123', 'Petra', 'Svobodová', 'Dlouhá 5', 'Olomouc', '77900', 12, 'zena', ''),
                                                                                                                                 ('karel.dvorak@email.cz', 'heslo123', 'Karel', 'Dvořák', 'Krátká 8', 'Brno', '60200', 11, 'muz', 'Přestup z jiné fakulty'),
                                                                                                                                 ('eva.cerna@email.cz', 'heslo123', 'Eva', 'Černá', 'Nádražní 104', 'Praha', '11000', 1, 'zena', 'Stipendium'),
                                                                                                                                 ('lukas.kucera@email.cz', 'heslo123', 'Lukáš', 'Kučera', 'Lesní 3', 'Opava', '74601', 14, 'muz', ''),
                                                                                                                                 ('marie.vesela@email.cz', 'heslo123', 'Marie', 'Veselá', 'Polní 22', 'Zlín', '76001', 13, 'zena', 'Individuální plán');