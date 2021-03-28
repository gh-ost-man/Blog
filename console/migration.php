<?php
    require_once 'pdo_ini.php';
    use core\BaseController;

    $sql = <<<'SQL'
        CREATE TABLE IF NOT EXISTS `users`(
            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(255) NOT NULL,
            `nick` VARCHAR(255),
            `password` VARCHAR(255) NOT NULL,
            `url_avatar` VARCHAR(255),
            `role` VARCHAR(255),
            `confirm` TINYINT
        );
    SQL;
    
    try {
        $pdo->exec($sql);
        echo "success created table users";
        echo PHP_EOL;
    } catch(PDOException $e) {
        die("Error " . $e->getMessage());
    }

    $sql = <<<'SQL'
        CREATE TABLE IF NOT EXISTS `records`(
            `id` INT(25) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_user` INT(25) UNSIGNED NOT NULL,
            `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `status` VARCHAR(255) DEFAULT 'not approved',
            `text` VARCHAR(1000),
            `like` INT DEFAULT 0,
            `dis_like` INT DEFAULT 0,
            FOREIGN KEY (`id_user`) REFERENCES `users`(`id`)  ON DELETE CASCADE 
        );
    SQL;

    try {
        $pdo->exec($sql);
        echo "success created table records";
        echo PHP_EOL;
    } catch(PDOException $e) {
        die("Error " . $e->getMessage());
    }

    $sql = <<<'SQL'
        CREATE TABLE IF NOT EXISTS `comments`(
            `id` INT(25) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_user` INT(25) UNSIGNED NOT NULL,
            `id_record` INT(25) UNSIGNED NOT NULL,
            `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `status` VARCHAR(255) DEFAULT 'not approved',
            `text` VARCHAR(1000),
            `like` INT DEFAULT 0,
            `dis_like` INT DEFAULT 0,
            FOREIGN KEY (`id_user`) REFERENCES `users`(`id`)  ON DELETE CASCADE,
            FOREIGN KEY (`id_record`) REFERENCES `records`(`id`)  ON DELETE CASCADE 
        );
    SQL;

    try {
        $pdo->exec($sql);
        echo "success created table comments";
        echo PHP_EOL;
    } catch(PDOException $e) {
        die("Error " . $e->getMessage());
    }

    $users =
    [
        ['email' => 'admin@gmail.com','nick' =>  'Admin', 'password' => sha1(SALT . 'admin' . SALT), 'url_avatar' => 'avatar/3.jpg','role' => 'Administrator','confirm' => '1'],
        ['email' => 'author1@gmail.com','nick' =>  'John Black', 'password' => sha1(SALT . 'author1' . SALT), 'url_avatar' => 'avatar/1.png','role' => 'Author','confirm' => '1'],
        ['email' => 'author2@gmail.com','nick' =>  'Devid White', 'password' => sha1(SALT . 'author2' . SALT), 'url_avatar' => 'avatar/2.png','role' => 'Author','confirm' => '1'],
        ['email' => 'author3@gmail.com','nick' =>  'Alex McArtur', 'password' => sha1(SALT . 'author3' . SALT), 'url_avatar' => 'avatar/4.png','role' => 'Author','confirm' => '1'],
        ['email' => 'author4@gmail.com','nick' =>  'Steve Queen', 'password' => sha1(SALT . 'author4' . SALT), 'url_avatar' => 'avatar/5.jpg','role' => 'Author','confirm' => '1'],
        ['email' => 'author5@gmail.com','nick' =>  'Jack Brown', 'password' => sha1(SALT . 'author5' . SALT), 'url_avatar' => 'avatar/6.jpg','role' => 'Author','confirm' => '1'],
        ['email' => 'follower1@gmail.com','nick' =>  'Mike Green', 'password' => sha1(SALT . 'follower1' . SALT), 'url_avatar' => 'avatar/7.jpg','role' => 'Administrator','confirm' => '1'],
        ['email' => 'follower2@gmail.com','nick' =>  'John Shadow', 'password' => sha1(SALT . 'follower2' . SALT), 'url_avatar' => 'avatar/8.jpeg','role' => 'Administrator','confirm' => '1'],
        ['email' => 'follower3@gmail.com','nick' =>  'Michael Gray', 'password' => sha1(SALT . 'follower3' . SALT), 'url_avatar' => 'avatar/9.jpg','role' => 'Administrator','confirm' => '1'],
        ['email' => 'follower4@gmail.com','nick' =>  'Yuri Hunt', 'password' => sha1(SALT . 'follower4' . SALT), 'url_avatar' => 'avatar/10.jpg','role' => 'Administrator','confirm' => '1'],
        ['email' => 'follower5@gmail.com','nick' =>  'Dean Smith', 'password' => sha1(SALT . 'follower5' . SALT), 'url_avatar' => 'avatar/11.png','role' => 'Administrator','confirm' => '1']
    ];
    foreach($users as $user){
        $stmt = $pdo->prepare('INSERT INTO `users` (email,nick,password,url_avatar,role,confirm) VALUES (:email,:nick,:password,:url_avatar,:role,:confirm)');
    
        try{
            $stmt->execute(
                [
                ':email' => $user['email'],
                ':nick' => $user['nick'],
                ':password' => $user['password'],
                ':url_avatar' => $user['url_avatar'],
                ':role' => $user['role'],
                ':confirm' => $user['confirm']
                ]
            );
        } catch(PDOException $e){
            die("ERROR: " . $e->getMessage());
        }   
    }

    $records = 
    [
        [
            'id_user' => '2', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'About what the series "Shadowhunters":
            Ten years ago, a mother worried about the life of her little daughter asked to cast a protective spell on the girl in order to protect the baby from mortal danger, but sooner or later the truth that broke through the established barrier was destined to shed light on what was destined for her.
            Celebrating her eighteen-year-old, Clary Fray, an ordinary, unremarkable girl, suddenly finds out for herself that she belongs to the mysterious family of Shadowhunters - a mysterious organization that protects people from demons, messengers of evil, spawn of darkness and other wickedness that took on human guise and has flooded the whole white world lately. During a clash in a nightclub between hunters and demons, Clary accidentally kills one of the young boys, who turns out to be a monster. Unable to understand what is happening, the girl comes to her mother for answers, but she, sensing the impending danger, teleports Clary out of the apartment. And now our heroine has to finally find out the secret of her origin',
            'like' => '123',
            'dis_like' => '0'
        ],
        [
            'id_user' => '2', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the TV series "Supernatural" about?:
            As children, siblings Sam and Dean Winchester witnessed the tragic death of their mother at the hands of a supernatural being. Their father John took up the upbringing of children, teaching the boys all the tricks of the fight against evil spirits, while simultaneously looking for the murderer of his wife. Years later, the brothers, who grew up in constant danger and not afraid to risk their lives, continue the work of their dad, becoming hunters for demons, evil spirits, werewolves and other mystical monsters, cutting across America in a 1967 Chevrolet Impala.',
            'like' => '212',
            'dis_like' => '0'
        ],
        [
            'id_user' => '2', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the series "Flash" about?:
            The plot of the fantastic television series "The Flash" ⚡️ was based on the comics of the popular publishing house DC Comics, telling about a superhero named Flash. It should also be noted that the series is a spin-off of the already popular Arrow series.
            As a child, the main character, Barry Allen, witnessed the murder of his own mother, for which his father was completely unjustly convicted. Growing up, Barry becomes a forensic scientist and does not give up trying to get to the bottom of the true truth about the murder of his mother. In the end, his investigation yields results and leads to a particle accelerator created by a scientist named Harrison Wells. As a result of the explosion of that very accelerator, the hero becomes a victim of a lightning strike, which is why he falls into a coma for nine long months. Coming out of it, Barry learns that he now has superhuman abilities. But he is not alone ...',
            'like' => '65',
            'dis_like' => '12'
        ],
        [
            'id_user' => '3', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the series "Lucifer" about?:
                Lucifer has lived in hell for thousands of years. But once the eccentric and charming king of the underworld gets tired of sitting in his possessions, and he decides to move not just anywhere, but to Los Angeles, in order to fully enjoy life in modern society. There he opens his own nightclub, where he spends most of his time. Until a certain moment, everything is going as well as possible, but one day, right on the doorstep of his club, unknown people brutally kill a young singer, to whom our hero was not indifferent.
                Using his supernatural powers, the king of hell convinces the police to take him as an assistant, after which, joining forces with an experienced police detective named Chloe, he takes on the investigation of this crime. From that moment on, his stay in the human world takes on a completely different meaning, and Lucifer will have many exciting adventures ahead, in which he will have to use his unusual abilities more than once ...',
            'like' => '156',
            'dis_like' => '0'
        ],
        [
            'id_user' => '3', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the film "Greenland" about?:
            A comet is approaching the Earth at great speed, which threatens to destroy all life on the planet. The only safe place is a bunker in distant Greenland, where only a small part of the Earth s population can be evacuated. John Garrity, his wife Alison, and their little son Nathan embark on a perilous journey in hopes of finding refuge. However, not only cities and roads destroyed by a comet stand in their way, but also distraught people who, during a global catastrophe, show their worst qualities ...',
            'like' => '97',
            'dis_like' => '17'
        ],
        [
            'id_user' => '2', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the film "Prince of Persia: The Sands of Time":
            During a visit to one of the Persian markets, King Sharaman witnesses the noble deed of a street boy named Dastan. Delighted with his courage, the king decides to make the boy a member of his family. Sharaman does not deprive the boy of paternal love and treats the same as for his own sons. When the princes grow up, they all go on a military campaign together. On their way is the sacred city of Alamut, which, according to intelligence, is supplying weapons to their enemies. Contrary to the will of his father, the army of the Persians led by Prince Tas attacked the city, but having taken the city, no weapons were found there. Learning about the audacious act of his sons, King Sharaman goes to Alamut. During the celebration, in honor of the capture of the city, Dastan presents his father a mantle, which turns out to be poisoned, and the king dies. Everyone accuses the young prince of killing his father and tries to grab him, but he manages to escape, taking the princess of Alamut with him. Now Dastan has to find out who is actually responsible for the death of his father.',
            'like' => '154',
            'dis_like' => '23'
        ],
        [
            'id_user' => '4', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the movie "Bad Boys Forever" about?:
            At the center of the story are close friends and experienced police detectives - Marcus Burnett and Mike Lowry. Twenty-four years ago, Mike took part in the capture of an influential drug lord, and also made a significant contribution to the arrest of Isabella, the wife of a powerful criminal. After serving a long term in a Mexican maximum security prison, Isabella manages to escape, after which, with the support of her son, she opens a hunt for those involved in the death of her husband and her imprisonment. Mike s life is in grave danger, but Marcus will not leave an old friend in trouble ...',
            'like' => '2324',
            'dis_like' => '44'
        ],
        [
            'id_user' => '5', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the movie "Charlie s Angels" about:
            Traditional measures to combat crime turned out to be ineffective, so the Townsend agency was formed to help the world intelligence services, whose headquarters were opened in all key points of the planet. A distinctive feature of the unit was female operatives who, thanks to their charm and out-of-the-box thinking, coped with the most difficult missions. At the center of the story are former MI6 employee Jane Cano, professional seducer Sabina Wilson, and computer specialist Elena Hoflin, tasked with catching a dangerous arms dealer and preventing the latest military development from entering the black market ...',
            'like' => '1289',
            'dis_like' => '37'
        ],
        [
            'id_user' => '6', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the film "The Fall of Olympus":
            Michael Banning works for the US President s Security Service. He does his job well. But one day an attempt is made on the head of state and the first lady. Michael manages to save the president, but his wife does not, after which he is transferred to another, less responsible job. However, when the White House is attacked by terrorists, Bening finds himself inside the building.
            They threaten to assassinate the president and use nuclear warheads. While the government cannot cope with the situation and find at least some way out of it, Michael himself is making an attempt to save the head of state.',
            'like' => '234',
            'dis_like' => '9'
        ],
        [
            'id_user' => '6', 
            'date'=> (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'What is the film "The Fall of London" about:
            A resonant event takes place in London - the British Prime Minister dies under strange, unexplained circumstances. This tragic incident brings together many of the most influential rulers of the leading countries of the Western world, who have arrived in England to express their condolences and take part in the funeral ceremony. Who would have thought that this event, the security of which is observed at the highest level, so that each of its participants could feel protected from any unforeseen incidents, would turn into an attempt to assassinate the most influential world leaders, whose death could entail horrific consequences for the whole world ... The only ones who do not lose hope of preventing the irreparable are US President Benjamin Asher, his best secret service agent Mike Banning,',
            'like' => '2328',
            'dis_like' => '65'
        ]
    ];

    foreach($records as $record){
        $stmt = $pdo->prepare('INSERT INTO `records` (id_user, date, status, text, `like`, dis_like) VALUES (:id_user,:date,:status,:text,:like,:dis_like)');
    
        try{
            $stmt->execute(
                [
                ':id_user' => $record['id_user'],
                ':date' => $record['date'],
                ':status' => $record['status'],
                ':text' => $record['text'],
                ':like' => $record['like'],
                ':dis_like' => $record['dis_like']
                ]
            );
        } catch(PDOException $e){
            die("ERROR: " . $e->getMessage());
        }   
    }
   
    $comments = 
    [
        [
            'id_user' => '2', 
            'id_record'=> '1',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'like'=> '42',
            'dis_like'=> '12',
        ],
        [
            'id_user' => '3', 
            'id_record'=> '1',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eos nesciunt, assumenda recusandae culpa obcaecati perferendis pariatur odio, mollitia, neque sequi ea deleniti tempore libero sed eaque aspernatur quibusdam laborum.',
            'like'=> '67',
            'dis_like'=> '32',
        ],
        [
            'id_user' => '4', 
            'id_record'=> '1',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus quaerat, dolore, blanditiis doloribus maiores inventore sequi laboriosam pariatur architecto, facere nemo vero ex consequuntur ullam quae odio eveniet odit nulla.',
            'like'=> '42',
            'dis_like'=> '12',
        ],
        [
            'id_user' => '5', 
            'id_record'=> '1',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste fugiat sint reiciendis, fuga officiis consequatur placeat, incidunt vero corporis non consectetur fugit pariatur adipisci ex dolor harum doloremque id voluptate.
            Fuga quasi deserunt exercitationem tenetur! Pariatur placeat aliquid hic animi magnam earum esse. Architecto, quia ab. Voluptatem sit molestias quam quasi dolor officiis magnam impedit at, odit, consequatur porro saepe.',
            'like'=> '42',
            'dis_like'=> '12',
        ],
        [
            'id_user' => '4', 
            'id_record'=> '2',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium beatae nobis velit deserunt, asperiores similique est eveniet alias architecto earum iusto non quas corrupti, delectus saepe et, adipisci repellat quod.',
            'like'=> '113',
            'dis_like'=> '87',
        ],
        [
            'id_user' => '4', 
            'id_record'=> '3',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> '    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel accusamus quam explicabo cum id libero dolorem, odio soluta qui. Reiciendis beatae deserunt totam nemo magnam optio corrupti assumenda, ut natus.
            Sapiente odit, aspernatur quaerat, vel, dicta deserunt quasi mollitia magnam incidunt magni ducimus ullam? Neque exercitationem tempora quae autem eius, eos vero soluta necessitatibus quam dicta qui, placeat nihil quo?
            Dicta veritatis amet voluptate molestias numquam harum debitis, voluptatum praesentium optio quod rerum eius accusantium iure ad aspernatur ullam at ab quia iusto sunt illum? Eos voluptates delectus quibusdam deleniti.',
            'like'=> '421',
            'dis_like'=> '98',
        ],
        [
            'id_user' => '5', 
            'id_record'=> '5',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> '  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore dolores ea eum cupiditate quasi fugiat, accusantium expedita eveniet autem minima cumque nostrum? Labore esse fugit quam obcaecati provident modi repellat.',
            'like'=> '982',
            'dis_like'=> '512',
        ],
        [
            'id_user' => '6', 
            'id_record'=> '5',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> '  Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus assumenda placeat, voluptatum totam fugit nihil obcaecati quis, deserunt optio, et asperiores explicabo praesentium voluptates dolores impedit beatae mollitia aperiam! Nostrum.
            ',
            'like'=> '333',
            'dis_like'=> '22',
        ],
        [
            'id_user' => '6', 
            'id_record'=> '7',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'like'=> '42',
            'dis_like'=> '12',
        ],
        [
            'id_user' => '4', 
            'id_record'=> '8',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> '  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum et recusandae error? Ipsum eligendi vel fuga provident. Impedit deleniti quis dignissimos voluptatem. Nobis quaerat, reprehenderit error nam qui eveniet sed!',
            'like'=> '92',
            'dis_like'=> '21',
        ],
        [
            'id_user' => '2', 
            'id_record'=> '8',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos, fugit dignissimos! Dolore maiores, quis repellendus id, atque, tempora praesentium illum enim excepturi impedit reiciendis. Exercitationem iure pariatur quasi minus? Libero!
            Rerum autem nobis doloribus maxime repudiandae inventore dignissimos veritatis voluptas fuga soluta? Commodi distinctio alias quas earum? Aliquam, maxime? Blanditiis doloribus libero molestias commodi fugiat. Perferendis, mollitia tempora. Dicta, dolor.
            Vitae, libero? Maiores esse voluptate sed inventore! Reprehenderit, non ab illum excepturi eligendi maiores quia corporis veritatis pariatur asperiores adipisci aperiam rem voluptatem deserunt optio sunt provident, sit commodi in?',
            'like'=> '198',
            'dis_like'=> '209',
        ],
        [
            'id_user' => '3', 
            'id_record'=> '10',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> '  
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat, magni, tempore ipsam quo voluptas praesentium voluptate rem architecto commodi nesciunt suscipit ullam quia totam amet eaque atque ipsa accusamus! Veritatis?',
            'like'=> '42',
            'dis_like'=> '219',
        ],
        [
            'id_user' => '6', 
            'id_record'=> '1',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum ducimus deleniti tenetur aperiam eos alias deserunt praesentium quibusdam ex. Dolor saepe iste a quia asperiores quos incidunt optio error ad!
            Ipsum, distinctio! Magni aut aliquid nam saepe tempore accusamus culpa placeat, architecto ex ea ullam repellendus et iusto perspiciatis! Temporibus incidunt alias modi fugiat impedit totam porro placeat quas. Adipisci.',
            'like'=> '42',
            'dis_like'=> '12',
        ],
        [
            'id_user' => '5', 
            'id_record'=> '2',
            'date'=> (new DateTime())->format('Y-m-d'),
            'status'=> 'approved',
            'text'=> 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iure illo nisi nesciunt voluptatibus necessitatibus fugit facere quas, provident nihil, enim doloremque praesentium maxime. Culpa ipsum placeat officiis quod numquam quaerat!',
            'like'=> '5412',
            'dis_like'=> '123',
        ],
        [
            'id_user' => '5', 
            'id_record' => '3',
            'date' => (new DateTime())->format('Y-m-d'),
            'status' => 'approved',
            'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'like' => '42',
            'dis_like' => '12',
        ]
    ];

    foreach($comments as $comment){
        $stmt = $pdo->prepare('INSERT INTO `comments` (`id_user`, `id_record`, `date`, `status`, `text`, `like`, `dis_like`) VALUES (:id_user, :id_record, :date, :status, :text, :like, :dis_like)');
    
        try{
            $stmt->execute(
                [
                ':id_user' => $comment['id_user'],
                ':id_record' => $comment['id_record'],
                ':date' => $comment['date'],
                ':status' => $comment['status'],
                ':text' => $comment['text'],
                ':like' => $comment['like'],
                ':dis_like' => $comment['dis_like']
                ]
            );
        } catch(PDOException $e){
            die("ERROR: " . $e->getMessage());
        }   
    }