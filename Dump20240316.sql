-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: recipedb
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `author_UNIQUE` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (5,'James Martin'),(1,'Jo Pratt'),(2,'Justine Pattison'),(4,'Nargisse Benkabbou'),(7,'Sabrina Ghayour'),(6,'Samin Nosrat'),(3,'Sunil Vijayakar');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_UNIQUE` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'aesthetics'),(1,'difficulty'),(3,'taste');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course` (
  `id` int NOT NULL AUTO_INCREMENT,
  `course` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`course`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (3,'Dessert'),(2,'Main'),(1,'Starter');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diet`
--

DROP TABLE IF EXISTS `diet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `diet` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `diet_UNIQUE` (`diet`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diet`
--

LOCK TABLES `diet` WRITE;
/*!40000 ALTER TABLE `diet` DISABLE KEYS */;
INSERT INTO `diet` VALUES (4,'Omni'),(3,'Pescetarian'),(1,'Vegan'),(2,'Vegetarian');
/*!40000 ALTER TABLE `diet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourite`
--

DROP TABLE IF EXISTS `favourite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favourite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `recipe_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourite`
--

LOCK TABLES `favourite` WRITE;
/*!40000 ALTER TABLE `favourite` DISABLE KEYS */;
/*!40000 ALTER TABLE `favourite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ingredient` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ingredient_UNIQUE` (`ingredient`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient`
--

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;
INSERT INTO `ingredient` VALUES (84,'Alfonso mango pulp'),(8,'antipasti marinated mushrooms'),(21,'baking powder'),(12,'balsamic vinegar'),(50,'basmati rice'),(46,'boneless lamb tenderloin or leg'),(76,'brown sugar'),(74,'butter'),(20,'caster sugar'),(92,'celery salt'),(7,'chopped tomatoes'),(43,'coriander leaves and stalks'),(29,'courgette'),(52,'couscous'),(83,'cream cheese'),(79,'digestive biscuits'),(47,'double cream'),(32,'dried chilli flakes'),(54,'dried cranberries'),(88,'dried mint'),(35,'dried oregano'),(10,'dried oregano or a small handful of fresh leaves, chopped'),(17,'dried spaghetti'),(11,'dried thyme or a small handful of fresh leaves, chopped'),(31,'extra virgin olive oil'),(77,'flaked almonds'),(58,'flatleaf parsley'),(71,'free-range eggs'),(16,'fresh basil leaves'),(9,'fresh or dried bay leaves'),(15,'freshly ground pepper'),(48,'full-fat milk'),(27,'full-fat plain yoghurt'),(4,'garlic'),(93,'garlic granules'),(90,'garlic oil'),(38,'ginger'),(80,'granulated sugar'),(37,'Greek or natural yoghurt'),(45,'green chillies'),(41,'ground cardamom seeds'),(98,'ground coriander'),(40,'ground cumin'),(72,'icing sugar'),(39,'Kashmiri red chilli powder'),(5,'lean minced beef'),(86,'lemon juice'),(42,'lime'),(70,'milk'),(44,'mint leaves'),(57,'olive oil'),(1,'olive oil or sun-dried tomato oil from the jar'),(3,'onion'),(89,'oyster mushrooms'),(18,'parmesan'),(34,'passata sauce'),(97,'pickled chillies'),(55,'pine nuts'),(73,'plain flour'),(75,'plums'),(51,'pomegranate seeds'),(82,'powdered gelatine'),(53,'preserved lemons'),(33,'ready-grated mozzarella or cheddar, goats’ cheese, broken into small chunks, or 1 mozzarella ball, sliced or roughly torn'),(30,'red onion'),(6,'red wine'),(59,'red wine vinegar'),(60,'rocket leaves'),(85,'rose harissa'),(49,'saffron strands'),(14,'salt'),(22,'sea salt'),(26,'self-raising brown or self-raising wholemeal flour'),(19,'self-raising flour'),(2,'smoked streaky bacon'),(23,'soya milk or almond milk'),(13,'sun-dried tomato halves, in oil'),(25,'sunflower oil'),(91,'sweet paprika'),(96,'tomatoes'),(81,'unsalted butter'),(56,'unsalted shelled pistachio nuts'),(24,'vanilla extract'),(36,'vegetable oil'),(95,'white cabbage'),(94,'white pitta breads'),(87,'white wine vinegar'),(28,'yellow or orange pepper');
/*!40000 ALTER TABLE `ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `recipe_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `recipe_id` (`recipe_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `CK_Table_Column_Range` CHECK (((`rating` >= 1) and (`rating` <= 5)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `diet_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `recipe` varchar(128) DEFAULT NULL,
  `servings` int DEFAULT NULL,
  `tagline` varchar(256) DEFAULT NULL,
  `preparation` int DEFAULT NULL,
  `cooking` int DEFAULT NULL,
  `image_path` varchar(128) DEFAULT NULL,
  `added` date DEFAULT NULL,
  `featured` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `recipe_UNIQUE` (`recipe`),
  KEY `diet_id` (`diet_id`),
  KEY `course_id` (`course_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`diet_id`) REFERENCES `diet` (`id`),
  CONSTRAINT `recipe_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `recipe_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (1,4,2,1,'Spaghetti Bolognese',6,'Once you\'ve got this grown-up spag bol going, the hob will do the rest. Any leftovers will taste even better the next day. ',30,60,'spaghetti_bolognese.jpg','2019-05-12',1),(2,1,3,2,'Vegan Pancakes',2,'Try this vegan fluffy American pancake recipe for a perfect start to the day. Serve these pancakes with fresh berries, maple syrup or chocolate sauce for a really luxurious start to the day.',30,15,'vegan_american_pancakes.jpg','2019-11-23',1),(3,2,2,2,'Healthy Pizza',2,'No yeast required for this easy, healthy pizza, topped with colourful vegetables that\'s ready in 30 minutes. This is a great recipe if you want to feed the kids in a hurry!',30,15,'healthy_pizza.jpg','2020-04-05',0),(4,4,2,3,'Easy Lamb Biryani',6,'This lamb biryani is real centrepiece dish, but it\'s actually easy as anything to make. Serve garnished with pomegranate seeds to make it look really special.',480,90,'easy_lamb_biryani.jpg','2020-08-17',0),(5,1,2,4,'Couscous Salad',6,'A nutritious and satisfying vegan couscous salad packed with colour, flavour and texture, from dried cranberries, pistachios and pine nuts.',30,10,'couscous_salad.jpg','2021-01-29',0),(6,2,3,5,'Plum Clafoutis',4,'Halved plums are covered in a light batter and then baked in the oven to make this traditional French dessert. British plums are at their best in September, so make the most of them then and try this simple pud.',30,45,'plum_clafoutis.jpg','2021-06-14',0),(7,2,3,6,'Mango Pie',16,'This mouthwatering mango dessert is an Indian take on a traditional Thanksgiving pie.',45,45,'mango_pie.jpg','2022-07-03',0),(8,2,2,7,'Mushroom Doner',4,'A meat-free mushroom \'doner\' kebab packed with two types of sauces, pickles and veg. A mighty delicious vegetarian dish.',30,20,'mushroom_doner.jpg','2023-03-30',0);
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_ingredient`
--

DROP TABLE IF EXISTS `recipe_ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int DEFAULT NULL,
  `ingredient_id` int DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `unit` varchar(16) DEFAULT NULL,
  `preprep` varchar(64) DEFAULT NULL,
  `suffix` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_id` (`recipe_id`),
  KEY `ingredient_id` (`ingredient_id`),
  CONSTRAINT `recipe_ingredient_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  CONSTRAINT `recipe_ingredient_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ingredient`
--

LOCK TABLES `recipe_ingredient` WRITE;
/*!40000 ALTER TABLE `recipe_ingredient` DISABLE KEYS */;
INSERT INTO `recipe_ingredient` VALUES (1,1,1,2,'tbs',NULL,NULL),(2,1,2,6,'rashers',NULL,NULL),(3,1,3,2,'',NULL,NULL),(4,1,4,3,'cloves','crushed',NULL),(5,1,5,1,'kg',NULL,NULL),(6,1,6,2,'large glasses',NULL,NULL),(7,1,7,800,'g',NULL,NULL),(8,1,8,290,'g','drained',NULL),(9,1,9,2,'leaves',NULL,NULL),(10,1,10,1,'tsp','chopped',NULL),(11,1,11,1,'tsp','chopped',NULL),(12,1,12,1,'drizzle',NULL,NULL),(13,1,13,12,NULL,NULL,NULL),(14,1,14,NULL,NULL,NULL,NULL),(15,1,15,NULL,NULL,NULL,NULL),(16,1,16,1,'handful','torn into small pieces',NULL),(17,1,17,1,'kg',NULL,NULL),(18,1,18,NULL,'lots',NULL,NULL),(19,2,19,125,'g',NULL,NULL),(20,2,20,2,'tbsp',NULL,NULL),(21,2,21,1,'tsp',NULL,NULL),(22,2,22,1,'good pinch',NULL,NULL),(23,2,23,150,'ml',NULL,NULL),(24,2,24,0.25,'tsp',NULL,NULL),(25,2,25,4,'tsp',NULL,'for frying'),(26,3,26,125,'g',NULL,'plus extra for dusting'),(27,3,22,1,'pinch',NULL,NULL),(28,3,27,125,'g',NULL,NULL),(29,3,28,1,NULL,'seeds removed and thinly sliced',NULL),(30,3,29,1,NULL,'cut into 1cm slices',NULL),(31,3,30,1,NULL,'cut into thin wedges',NULL),(32,3,31,1,'tbsp',NULL,'plus extra for drizzling'),(33,3,32,0.5,'tsp',NULL,NULL),(34,3,33,50,'g',NULL,NULL),(35,3,15,NULL,NULL,NULL,NULL),(36,3,16,NULL,NULL,NULL,'to serve'),(37,3,34,6,'tbsp',NULL,NULL),(38,3,35,1,'tsp',NULL,NULL),(39,4,36,5,'tbsp',NULL,NULL),(40,4,3,2,NULL,'finely sliced',NULL),(41,4,37,200,'g',NULL,NULL),(42,4,38,4,'tbsp','finely grated',NULL),(43,4,4,3,'tbsp','finely grated',NULL),(44,4,39,2,'tsp',NULL,NULL),(45,4,40,5,'tsp',NULL,NULL),(46,4,41,1,'tsp',NULL,NULL),(47,4,22,4,'tsp',NULL,NULL),(48,4,42,1,NULL,NULL,'juice only'),(49,4,43,30,'g','finely chopped',NULL),(50,4,44,30,'g','finely chopped',NULL),(51,4,45,3,NULL,'finely chopped',NULL),(52,4,46,800,'g','cut into bit- sized pieces',NULL),(53,4,47,4,'tbsp',NULL,NULL),(54,4,48,1.5,'tbsp',NULL,NULL),(55,4,49,1,'tsp',NULL,'(a large pinch)'),(56,4,50,400,'g',NULL,NULL),(57,4,51,2,'tbsp',NULL,'to garnish'),(58,5,52,225,'g','use packet instructions',NULL),(59,5,53,8,'small','flesh and rind finely chopped',NULL),(60,5,54,180,'g',NULL,NULL),(61,5,55,120,'g','toasted',NULL),(62,5,56,160,'g','roughtly chopped',NULL),(63,5,57,125,'ml',NULL,NULL),(64,5,58,60,'g','finely chopped',NULL),(65,5,4,4,'cloves','crushed',NULL),(66,5,59,4,'tbsp',NULL,NULL),(67,5,30,NULL,NULL,'finely chopped',NULL),(68,5,14,1,'tsp',NULL,'or to taste'),(69,5,60,80,'g',NULL,NULL),(70,6,70,125,'ml',NULL,NULL),(71,6,47,125,'ml',NULL,NULL),(72,6,24,3,'drops',NULL,NULL),(73,6,71,4,NULL,NULL,NULL),(74,6,20,170,'g',NULL,NULL),(75,6,73,1,'tbsp',NULL,NULL),(76,6,74,30,'g',NULL,NULL),(77,6,75,500,'g',NULL,'cut in half, stones removed'),(78,6,76,2,'tbsp',NULL,NULL),(79,6,77,30,'g',NULL,'(optional)'),(80,6,72,NULL,NULL,NULL,'for dusting'),(81,6,47,NULL,NULL,NULL,'to serve'),(82,7,79,280,'g',NULL,NULL),(83,7,80,65,'g',NULL,NULL),(84,7,41,0.25,'tsp',NULL,NULL),(85,7,81,128,'g',NULL,'melted'),(86,7,22,NULL,'large pinch',NULL,NULL),(87,7,80,100,'g',NULL,NULL),(88,7,82,2.25,'tsp',NULL,NULL),(89,7,47,120,'ml',NULL,NULL),(90,7,83,115,NULL,NULL,'at room temperature'),(91,7,84,850,'g',NULL,NULL),(92,7,22,NULL,'large pinch',NULL,NULL),(93,8,7,400,'g',NULL,NULL),(94,8,85,2,'tbsp',NULL,NULL),(95,8,20,2,'tsp',NULL,NULL),(96,8,86,NULL,'good squeeze',NULL,NULL),(97,8,3,1,NULL,'very thinly sliced into half moons',NULL),(98,8,87,2,'level tsp',NULL,NULL),(99,8,58,20,'g','','finely chopped'),(100,8,27,150,'g',NULL,NULL),(101,8,88,1,'heaped tsp',NULL,NULL),(102,8,14,NULL,NULL,NULL,NULL),(103,8,15,NULL,NULL,NULL,NULL),(104,8,89,500,'g',NULL,'very thinly sliced lengthways'),(105,8,90,2,'tsp',NULL,NULL),(106,8,91,2,'tsp',NULL,NULL),(107,8,98,2,'heaped tsp',NULL,NULL),(108,8,92,2,'tsp',NULL,NULL),(109,8,93,3,'tsp',NULL,NULL),(110,8,15,0.5,'tsp',NULL,NULL),(111,8,94,4,NULL,NULL,NULL),(112,8,95,0.25,NULL,NULL,NULL),(113,8,96,2,NULL,NULL,'sliced into half moons'),(114,8,97,5,NULL,NULL,'thinly sliced (optional)');
/*!40000 ALTER TABLE `recipe_ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `recipe_view`
--

DROP TABLE IF EXISTS `recipe_view`;
/*!50001 DROP VIEW IF EXISTS `recipe_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `recipe_view` AS SELECT 
 1 AS `id`,
 1 AS `diet_id`,
 1 AS `course_id`,
 1 AS `author_id`,
 1 AS `recipe`,
 1 AS `servings`,
 1 AS `tagline`,
 1 AS `preparation`,
 1 AS `cooking`,
 1 AS `image_path`,
 1 AS `added`,
 1 AS `featured`,
 1 AS `author`,
 1 AS `diet`,
 1 AS `course`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `step`
--

DROP TABLE IF EXISTS `step`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `step` (
  `id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int DEFAULT NULL,
  `step_no` int DEFAULT NULL,
  `step` varchar(512) DEFAULT NULL,
  `minutes` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `step_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `step`
--

LOCK TABLES `step` WRITE;
/*!40000 ALTER TABLE `step` DISABLE KEYS */;
INSERT INTO `step` VALUES (1,1,1,'Heat the oil in a large, heavy-based saucepan and fry the bacon until golden over a medium heat. Add the onions and garlic, frying until softened. Increase the heat and add the minced beef. Fry it until it has browned, breaking down any chunks of meat with a wooden spoon. Pour in the wine and boil until it has reduced in volume by about a third. Reduce the temperature and stir in the tomatoes, drained mushrooms, bay leaves, oregano, thyme and balsamic vinegar.',30),(2,1,2,'Either blitz the sun-dried tomatoes in a small blender with a little of the oil to loosen, or just finely chop before adding to the pan. Season well with salt and pepper. Cover with a lid and simmer the Bolognese sauce over a gentle heat for 1-1½ hours until it\'s rich and thickened, stirring occasionally. At the end of the cooking time, stir in the basil and add any extra seasoning if necessary.',90),(3,1,3,'Remove from the heat to \'settle\' while you cook the spaghetti in plenty of boiling salted water (for the time stated on the packet). Drain and divide between warmed plates. Scatter a little parmesan over the spaghetti before adding a good ladleful of the Bolognese sauce, finishing with a scattering of more cheese and a twist of black pepper.',15),(4,2,1,'Put the flour, sugar, baking powder and salt in a bowl and mix thoroughly. Add the milk and vanilla extract and mix with a whisk until smooth.',5),(5,2,2,'Place a large non-stick frying pan over a medium heat. Add 2 teaspoons of the oil and wipe around the pan with a heatproof brush or carefully using a thick wad of kitchen paper.',2),(6,2,3,'Once the pan is hot, pour a small ladleful (around two dessert spoons) of the batter into one side of the pan and spread with the back of the spoon until around 10cm/4in in diameter. Make a second pancake in exactly the same way, greasing the pan with the remaining oil before adding the batter.',10),(7,2,4,'Cook for about a minute, or until bubbles are popping on the surface and just the edges look dry and slightly shiny. Quickly and carefully flip over and cook on the other side for a further minute, or until light, fluffy and pale golden brown. If you turn the pancakes too late, they will be too set to rise evenly. You can always flip again if you need the first side to go a little browner.',2),(8,2,5,'Transfer to a plate and keep warm in a single layer (so they don\'t get squished) on a baking tray in a low oven while the rest of the pancakes are cooked in exactly the same way. Serve with your preferred toppings.',10),(9,3,1,'Preheat the oven to 220C/200C Fan/Gas 7.',1),(10,3,2,'To prepare the topping, put the pepper, courgette, red onion and oil in a bowl, season with lots of black pepper and mix together. Scatter the vegetables over a large baking tray and roast for 15 minutes.',15),(11,3,3,'Meanwhile, make the pizza base. Mix the flour and salt in a large bowl. Add the yoghurt and 1 tablespoon of cold water and mix with a spoon, then use your hands to form a soft, spongy dough. Turn out onto a lightly floured surface and knead for about 1 minute.',5),(12,3,4,'Using a floured rolling pin, roll the dough into a roughly oval shape, approx. 3mm/⅛in thick, turning regularly. (Ideally, the pizza should be around 30cm/12in long and 20cm/8in wide, but it doesn’t matter if the shape is uneven, it just needs to fit onto the same baking tray that the vegetables were cooked on.)',2),(13,3,5,'Transfer the roasted vegetables to a bowl. Slide the pizza dough onto the baking tray and bake for 5 minutes. Take the tray out of the oven and turn the dough over.',5),(14,3,6,'For the tomato sauce, mix the passata with the oregano and spread over the dough. Top with the roasted vegetables, sprinkle with the chilli flakes and then the cheese. Bake the pizza for a further 8–10 minutes, or until the dough is cooked through and the cheese beginning to brown.',10),(15,3,7,'Season with black pepper, drizzle with a slurp of olive oil and, if you like, scatter fresh basil leaves on top just before serving.',2),(16,4,1,'Heat the oil in a non-stick frying pan over a medium heat. Add the onions and stir-fry for 15–18 minutes, or until lightly browned and crispy.',20),(17,4,2,'Put half the onions in a non-metallic mixing bowl with the yoghurt, ginger, garlic, chilli powder, cumin, cardamom, half of the salt, the lime juice, half of the chopped coriander and mint and the green chillies. Stir well to combine. Set aside the remaining coriander and mint for layering the biryani.',2),(18,4,3,'Add the lamb to the mixture and stir to coat evenly. Cover and marinade in the fridge for 6–8 hours, or overnight if possible.',360),(19,4,4,'Preheat the oven to 240C/Fan 220C/Gas 9.',1),(20,4,5,'Heat the cream and milk in a small saucepan, add the saffron, remove from the heat and leave to infuse for 30 minutes.',35),(21,4,6,'Cook the rice in a large saucepan in plenty of boiling water with the remaining salt for 6–8 minutes, or until it is just cooked, but still has a bite. Drain the rice.',8),(22,4,7,'Spread half of the lamb mixture evenly in a wide, heavy-based casserole and cover with a layer of half the rice. Sprinkle over half of the reserved onions and half of the reserved coriander and mint. Sprinkle over half of the saffron mixture. Repeat with the remaining lamb, rice, onions, herbs and saffron mixture.',5),(23,4,8,'Cover with a tight fitting lid, turn down the oven to 200C/Fan 180C/Gas 6 and cook for 1 hour. Remove and allow to stand for 15–20 minutes before serving. Garnish with pomegranate seeds if desired.',80),(24,5,1,'In a large bowl mix all the ingredients together except the rocket, then taste and adjust the seasoning, adding more salt if necessary. Toss in the rocket and serve immediately.',5),(25,6,1,'Preheat the oven to 180C/350F/Gas 4.',1),(26,6,2,'Pour the milk, cream and vanilla into a pan and boil for a minute. Remove from the heat and set aside to cool.',5),(27,6,3,'Tip the eggs and sugar into a bowl and beat together until light and fluffy. Fold the flour into the mixture, a little at a time.',5),(28,6,4,'Pour the cooled milk and cream onto the egg and sugar mixture, whisking lightly. Set aside.',3),(29,6,5,'Place a little butter into an ovenproof dish and heat in the oven until foaming. Add the plums and brown sugar and bake for 5 minutes, then pour the batter into the dish and scatter with flaked almonds, if using.',20),(30,6,6,'Cook in the oven for about 30 minutes, until golden-brown and set but still light and soft inside.',30),(31,6,7,'Dust with icing sugar and serve immediately with cream.',2),(32,7,1,'To make the biscuit base, finely crush the biscuits by putting into a sealed plastic bag and bashing with a rolling pin (alternatively, pulse to crumbs using a food processor). Transfer to a mixing bowl and add the sugar, cardamom and salt, stirring well to combine.',5),(33,7,2,'Pour the melted butter over the biscuit crumbs and mix, until thoroughly combined. Put half the crumb mixture in a 23cm/9in metal pie tin, and press evenly with your fingers. Build up the sides of the tin, compressing the base as much as possible to prevent it crumbling. Repeat with the rest of the mixture in the second tin.',5),(34,7,3,'Preheat the oven to 160C/325F/Gas 3. Put the pie bases in the freezer for 15 minutes. Remove and bake for 12 minutes, or until golden brown. Transfer to a wire rack to cool.',3),(35,7,4,'To make the filling, pour 177ml/6fl oz of cold water into a large bowl. In a separate bowl, mix the gelatine with half the sugar and sprinkle over the water. Leave to stand for a couple of minutes.',2),(36,7,5,'Meanwhile, whip the cream with the remaining sugar to form medium stiff peaks. Set aside.',3),(37,7,6,'Heat about a quarter of the mango pulp in a saucepan over a medium-low heat, until just warm. Make sure you do not boil it. Pour into the gelatine mixture and whisk, until well combined. The gelatine should dissolve completely. Gradually whisk in the remaining mango pulp.',3),(38,7,7,'Beat the cream cheese in a bowl, until soft and smooth. Add to the mango mixture with the salt. Blend the mixture using a hand blender, until completely smooth. Gently tap the bowl on the kitchen counter once or twice to pop any air bubbles.',3),(39,7,8,'Fold about a quarter of the mango mixture into the whipped cream using a spatula. Repeat with the rest of the cream, until no streaks remain.',3),(40,7,9,'Divide the filling between the cooled bases, using a rubber spatula to smooth out the filling. Refrigerate overnight, or for at least 5 hours, until firm and chilled.',5),(41,8,1,'Preheat the oven to 180C/200C Fan/Gas 4.',1),(42,8,2,'To make the chilli sauce, heat the chopped tomatoes, rose harissa, sugar and lemon juice in a small saucepan over a medium heat. Bring to a gentle boil and cook for 10 minutes, stirring regularly, until reduced to a thick sauce-like consistency. Remove from the heat and set aside to cool. You can blend the sauce until it’s smooth using a hand-blender if you like, or just leave it chunky.',15),(43,8,3,'For the onion, mix together the onion slices, vinegar and parsley and set aside.',3),(44,8,4,'To make the yoghurt sauce, mix the yoghurt with the dried mint, season with salt and pepper and set aside.',2),(45,8,5,'Put the pittas in the oven to warm for 5 minutes.',5),(46,8,6,'To make the \'doner\', heat a frying pan over a medium-high heat. Add the mushrooms and dry-fry for 2 minutes, stirring once or twice. Add the garlic oil, paprika, coriander, celery salt, garlic granules and black pepper and quickly coat the mushrooms. Add 2–3 tablespoons of water to the pan and stir-fry for 1 minute before removing from the heat.',5),(47,8,7,'Split the warmed pitta breads. Spoon a little white cabbage into each pitta and add a little tomato and onion. Divide the mushrooms between the pittas, add a little more cabbage and tomato, then drizzle with the chilli and yoghurt sauces. Serve immediately, topped with the pickled chillies, if using.',5);
/*!40000 ALTER TABLE `step` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tip`
--

DROP TABLE IF EXISTS `tip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int DEFAULT NULL,
  `tip_no` int DEFAULT NULL,
  `tip` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `tip_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip`
--

LOCK TABLES `tip` WRITE;
/*!40000 ALTER TABLE `tip` DISABLE KEYS */;
INSERT INTO `tip` VALUES (1,1,1,'You can make a veggie version of this recipe by substituting soya mince or Quorn for the meat, adding it to the sauce halfway through cooking.'),(2,1,2,'Or simply add lots of diced vegetables to the onions, such as courgettes, carrots, peppers and aubergines.'),(3,2,1,'Whipped coconut cream is good with these too, but it must be well chilled before whipping.'),(4,2,2,'You can keep the pancakes warm in a low oven while you make the full batch.'),(5,3,1,'You can use any cheese you like for this pizza – it’s also a great way to use up a mix of odds and ends from the fridge.'),(6,3,2,'Make two pizzas instead of one large pizza if you like.'),(7,3,3,'Any leftover passata can be used for pasta sauces, stews or curries. It freezes well for up to 4 months. Instead of passata, you can use a bought pizza topping or strained tinned tomatoes.'),(8,3,4,'If you don’t have self-raising wholemeal flour, use plain wholemeal flour and add 1 teaspoon of baking powder and an extra tablespoon of water if needed.'),(9,4,1,'Kashmiri red chilli powder is quite mild with a slightly smoky flavour that really adds to the dish.'),(10,5,1,'Couscous salads are great to make ahead for easy entertaining or weekday lunches. It will keep well for a few days in the fridge.'),(11,7,1,'This recipe makes two pies, so halve the ingredients if you\'re not feeding a crowd.');
/*!40000 ALTER TABLE `tip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` int DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `pword` varchar(128) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `recipe_view`
--

/*!50001 DROP VIEW IF EXISTS `recipe_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `recipe_view` AS select `r`.`id` AS `id`,`r`.`diet_id` AS `diet_id`,`r`.`course_id` AS `course_id`,`r`.`author_id` AS `author_id`,`r`.`recipe` AS `recipe`,`r`.`servings` AS `servings`,`r`.`tagline` AS `tagline`,`r`.`preparation` AS `preparation`,`r`.`cooking` AS `cooking`,`r`.`image_path` AS `image_path`,`r`.`added` AS `added`,`r`.`featured` AS `featured`,`a`.`author` AS `author`,`d`.`diet` AS `diet`,`c`.`course` AS `course` from (((`recipe` `r` join `diet` `d` on((`r`.`diet_id` = `d`.`id`))) join `author` `a` on((`r`.`author_id` = `a`.`id`))) join `course` `c` on((`r`.`course_id` = `c`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-16 13:51:16
