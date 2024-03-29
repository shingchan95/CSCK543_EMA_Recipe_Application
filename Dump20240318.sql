CREATE DATABASE  IF NOT EXISTS `recipedb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `recipedb`;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (8,'Ben Rebuck'),(12,'Hugh Fearnley-Whittingstall'),(5,'James Martin'),(1,'Jo Pratt'),(2,'Justine Pattison'),(10,'Liza Ahmed Chowdhury'),(4,'Nargisse Benkabbou'),(11,'Rick Stein'),(7,'Sabrina Ghayour'),(6,'Samin Nosrat'),(3,'Sunil Vijayakar'),(9,'The Hairy Bikers');
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
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient`
--

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;
INSERT INTO `ingredient` VALUES (126,'	semi-skimmed milk'),(84,'Alfonso mango pulp'),(162,'anchovies'),(8,'antipasti marinated mushrooms'),(21,'baking powder'),(12,'balsamic vinegar'),(50,'basmati rice'),(124,'beef stock'),(133,'black mustard seeds'),(161,'black olives'),(104,'black salt'),(166,'boiled, smoked ham'),(137,'boiling water'),(46,'boneless lamb tenderloin or leg'),(155,'brown crabmeat'),(76,'brown sugar'),(74,'butter'),(169,'caraway seed'),(122,'carrots'),(103,'cashew nuts'),(20,'caster sugar'),(121,'celery'),(92,'celery salt'),(123,'chestnut mushrooms'),(134,'chilli powder'),(7,'chopped tomatoes'),(160,'ciabatta'),(138,'cloves'),(43,'coriander leaves and stalks'),(127,'cornflour'),(29,'courgette'),(52,'couscous'),(83,'cream cheese'),(79,'digestive biscuits'),(47,'double cream'),(32,'dried chilli flakes'),(54,'dried cranberries'),(88,'dried mint'),(35,'dried oregano'),(10,'dried oregano or a small handful of fresh leaves, chopped'),(17,'dried spaghetti'),(11,'dried thyme or a small handful of fresh leaves, chopped'),(31,'extra virgin olive oil'),(129,'extra-mature cheddar'),(165,'fast-action dried yeast'),(77,'flaked almonds'),(58,'flatleaf parsley'),(142,'floury potatoes'),(143,'free-range egg yolks'),(71,'free-range eggs'),(16,'fresh basil leaves'),(9,'fresh or dried bay leaves'),(128,'freshly ground nutmeg'),(15,'freshly ground pepper'),(48,'full-fat milk'),(27,'full-fat plain yoghurt'),(135,'garam masala'),(4,'garlic'),(93,'garlic granules'),(90,'garlic oil'),(38,'ginger'),(80,'granulated sugar'),(37,'Greek or natural yoghurt'),(45,'green chillies'),(41,'ground cardamom seeds'),(98,'ground coriander'),(40,'ground cumin'),(72,'icing sugar'),(152,'jam sugar with added pectin'),(167,'Jarlsberg cheese'),(39,'Kashmiri red chilli powder'),(141,'large cooked prawns'),(5,'lean minced beef'),(120,'leeks'),(86,'lemon juice'),(42,'lime'),(153,'long red chillies'),(163,'lukewarm water'),(70,'milk'),(44,'mint leaves'),(105,'miso paste'),(102,'nutritional yeast'),(57,'olive oil'),(1,'olive oil or sun-dried tomato oil from the jar'),(3,'onion'),(89,'oyster mushrooms'),(136,'paprika'),(18,'parmesan'),(168,'parsley'),(34,'passata sauce'),(97,'pickled chillies'),(55,'pine nuts'),(73,'plain flour'),(75,'plums'),(51,'pomegranate seeds'),(82,'powdered gelatine'),(53,'preserved lemons'),(156,'raw peeled king prawns'),(33,'ready-grated mozzarella or cheddar, goats’ cheese, broken into small chunks, or 1 mozzarella ball, sliced or roughly torn'),(30,'red onion'),(6,'red wine'),(59,'red wine vinegar'),(60,'rocket leaves'),(131,'rohu steaks'),(85,'rose harissa'),(49,'saffron strands'),(14,'salt'),(22,'sea salt'),(26,'self-raising brown or self-raising wholemeal flour'),(19,'self-raising flour'),(159,'shallot'),(101,'silken tofu'),(100,'smoked salt'),(2,'smoked streaky bacon'),(23,'soya milk or almond milk'),(158,'spring onions'),(164,'sugar'),(13,'sun-dried tomato halves, in oil'),(25,'sunflower oil'),(91,'sweet paprika'),(157,'thai green curry paste'),(125,'tomato puree'),(96,'tomatoes'),(99,'truffle oil'),(132,'turmeric'),(140,'undyed smoked haddock fillet'),(81,'unsalted butter'),(56,'unsalted shelled pistachio nuts'),(139,'unskinned pollock fillet'),(24,'vanilla extract'),(106,'vegan bacon'),(107,'vegan hard cheese'),(36,'vegetable oil'),(130,'vine tomatoes'),(95,'white cabbage'),(154,'white crabmeat'),(94,'white pitta breads'),(87,'white wine vinegar'),(28,'yellow or orange pepper');
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
  `tagline` varchar(512) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (1,4,2,1,'Spaghetti Bolognese',6,'Once you\'ve got this grown-up spag bol going, the hob will do the rest. Any leftovers will taste even better the next day. ',30,60,'spaghetti_bolognese.jpg','2019-05-12',1),(2,1,3,2,'Vegan Pancakes',2,'Try this vegan fluffy American pancake recipe for a perfect start to the day. Serve these pancakes with fresh berries, maple syrup or chocolate sauce for a really luxurious start to the day.',30,15,'vegan_american_pancakes.jpg','2019-11-23',1),(3,2,2,2,'Healthy Pizza',2,'No yeast required for this easy, healthy pizza, topped with colourful vegetables that\'s ready in 30 minutes. This is a great recipe if you want to feed the kids in a hurry!',30,15,'healthy_pizza.jpg','2020-04-05',0),(4,4,2,3,'Easy Lamb Biryani',6,'This lamb biryani is real centrepiece dish, but it\'s actually easy as anything to make. Serve garnished with pomegranate seeds to make it look really special.',480,90,'easy_lamb_biryani.jpg','2020-08-17',0),(5,1,2,4,'Couscous Salad',6,'A nutritious and satisfying vegan couscous salad packed with colour, flavour and texture, from dried cranberries, pistachios and pine nuts.',30,10,'couscous_salad.jpg','2021-01-29',0),(6,2,3,5,'Plum Clafoutis',4,'Halved plums are covered in a light batter and then baked in the oven to make this traditional French dessert. British plums are at their best in September, so make the most of them then and try this simple pud.',30,45,'plum_clafoutis.jpg','2021-06-14',0),(7,2,3,6,'Mango Pie',16,'This mouthwatering mango dessert is an Indian take on a traditional Thanksgiving pie.',45,45,'mango_pie.jpg','2022-07-03',0),(8,2,2,7,'Mushroom Doner',4,'A meat-free mushroom \'doner\' kebab packed with two types of sauces, pickles and veg. A mighty delicious vegetarian dish.',30,20,'mushroom_doner.jpg','2023-03-30',0),(9,1,2,8,'Vegan Carbonara',4,'This vegan version of a classic carbonara is really easy to make. Perfect for a quick vegan midweek meal.',30,45,'vegan_carbonara.jpg','2023-08-21',0),(10,4,2,9,'Skinny Beef Lasagne',6,'Who would have thought you could eat lasagne when on a diet? Well thanks to our amazingly clever recipe you can.',30,90,'skinny_beef_lasagne.jpg','2024-01-16',0),(11,3,2,10,'Fish Curry',4,'Rohu is commonly eaten in Bangladesh and is known as the king of fish. It can be difficult to source, but the recipe also works well with monkfish (which is similar in flavour and texture) or any firm white fish – just reduce the cooking time a little if the fish pieces are smaller.',30,45,'fish_curry.jpg','2024-02-06',0),(12,3,2,11,'Fish Pie',8,'The older I get, the keener I am to keep ingredients out of recipes instead of adding them. This is as simple a fish pie as you can imagine, but if the fish is good (and that includes the smoked fish, which must be of the best quality), there is no better fish dish in the world than British fish pie with boiled eggs and parsley.',120,90,'fish_pie.jpg','2024-03-15',0),(13,3,1,9,'Thai-style Crab Cakes with Quick Chilli Jam',6,'Crab cakes are quick to put together and make great party food or starters, plus this chilli jam will keep for a couple of weeks in the fridge.',30,10,'thai_crab_cakes.jpg','2024-03-16',0),(14,2,1,12,'Bruschetta',4,'Use the best tomatoes you can get hold of to make sure this very simple bruschetta delivers delicious a taste of Italy.',30,10,'bruschetta.jpg','2024-03-16',0),(15,4,1,9,'Savoury pies with Jarlsberg cheese and ham (Norwegian pierogi)',6,'Every country has something like these little pies – Polish pierogi, Indian samosas, Spanish and Argentinian empanadas – and this is Norway\'s version, made with Jarlsberg cheese and caraway seeds for that special Norwegian flavour. We give these dix points! If you\'re a lazybones you could use puff pastry, but you\'ll end up with something that\'s more like a fried pasty. Try these as a great little starter or beer blotter.',120,30,'savoury_pies.jpg','2024-03-17',0);
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
  `preprep` varchar(128) DEFAULT NULL,
  `suffix` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_id` (`recipe_id`),
  KEY `ingredient_id` (`ingredient_id`),
  CONSTRAINT `recipe_ingredient_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  CONSTRAINT `recipe_ingredient_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ingredient`
--

LOCK TABLES `recipe_ingredient` WRITE;
/*!40000 ALTER TABLE `recipe_ingredient` DISABLE KEYS */;
INSERT INTO `recipe_ingredient` VALUES (1,1,1,2,'tbs',NULL,NULL),(2,1,2,6,'rashers',NULL,NULL),(3,1,3,2,'',NULL,NULL),(4,1,4,3,'cloves','crushed',NULL),(5,1,5,1,'kg',NULL,NULL),(6,1,6,2,'large glasses',NULL,NULL),(7,1,7,800,'g',NULL,NULL),(8,1,8,290,'g','drained',NULL),(9,1,9,2,'leaves',NULL,NULL),(10,1,10,1,'tsp','chopped',NULL),(11,1,11,1,'tsp','chopped',NULL),(12,1,12,1,'drizzle',NULL,NULL),(13,1,13,12,NULL,NULL,NULL),(14,1,14,NULL,NULL,NULL,NULL),(15,1,15,NULL,NULL,NULL,NULL),(16,1,16,1,'handful','torn into small pieces',NULL),(17,1,17,1,'kg',NULL,NULL),(18,1,18,NULL,'lots',NULL,NULL),(19,2,19,125,'g',NULL,NULL),(20,2,20,2,'tbsp',NULL,NULL),(21,2,21,1,'tsp',NULL,NULL),(22,2,22,1,'good pinch',NULL,NULL),(23,2,23,150,'ml',NULL,NULL),(24,2,24,0.25,'tsp',NULL,NULL),(25,2,25,4,'tsp',NULL,'for frying'),(26,3,26,125,'g',NULL,'plus extra for dusting'),(27,3,22,1,'pinch',NULL,NULL),(28,3,27,125,'g',NULL,NULL),(29,3,28,1,NULL,'seeds removed and thinly sliced',NULL),(30,3,29,1,NULL,'cut into 1cm slices',NULL),(31,3,30,1,NULL,'cut into thin wedges',NULL),(32,3,31,1,'tbsp',NULL,'plus extra for drizzling'),(33,3,32,0.5,'tsp',NULL,NULL),(34,3,33,50,'g',NULL,NULL),(35,3,15,NULL,NULL,NULL,NULL),(36,3,16,NULL,NULL,NULL,'to serve'),(37,3,34,6,'tbsp',NULL,NULL),(38,3,35,1,'tsp',NULL,NULL),(39,4,36,5,'tbsp',NULL,NULL),(40,4,3,2,NULL,'finely sliced',NULL),(41,4,37,200,'g',NULL,NULL),(42,4,38,4,'tbsp','finely grated',NULL),(43,4,4,3,'tbsp','finely grated',NULL),(44,4,39,2,'tsp',NULL,NULL),(45,4,40,5,'tsp',NULL,NULL),(46,4,41,1,'tsp',NULL,NULL),(47,4,22,4,'tsp',NULL,NULL),(48,4,42,1,NULL,NULL,'juice only'),(49,4,43,30,'g','finely chopped',NULL),(50,4,44,30,'g','finely chopped',NULL),(51,4,45,3,NULL,'finely chopped',NULL),(52,4,46,800,'g','cut into bit- sized pieces',NULL),(53,4,47,4,'tbsp',NULL,NULL),(54,4,48,1.5,'tbsp',NULL,NULL),(55,4,49,1,'tsp',NULL,'(a large pinch)'),(56,4,50,400,'g',NULL,NULL),(57,4,51,2,'tbsp',NULL,'to garnish'),(58,5,52,225,'g','use packet instructions',NULL),(59,5,53,8,'small','flesh and rind finely chopped',NULL),(60,5,54,180,'g',NULL,NULL),(61,5,55,120,'g','toasted',NULL),(62,5,56,160,'g','roughtly chopped',NULL),(63,5,57,125,'ml',NULL,NULL),(64,5,58,60,'g','finely chopped',NULL),(65,5,4,4,'cloves','crushed',NULL),(66,5,59,4,'tbsp',NULL,NULL),(67,5,30,NULL,NULL,'finely chopped',NULL),(68,5,14,1,'tsp',NULL,'or to taste'),(69,5,60,80,'g',NULL,NULL),(70,6,70,125,'ml',NULL,NULL),(71,6,47,125,'ml',NULL,NULL),(72,6,24,3,'drops',NULL,NULL),(73,6,71,4,NULL,NULL,NULL),(74,6,20,170,'g',NULL,NULL),(75,6,73,1,'tbsp',NULL,NULL),(76,6,74,30,'g',NULL,NULL),(77,6,75,500,'g',NULL,'cut in half, stones removed'),(78,6,76,2,'tbsp',NULL,NULL),(79,6,77,30,'g',NULL,'(optional)'),(80,6,72,NULL,NULL,NULL,'for dusting'),(81,6,47,NULL,NULL,NULL,'to serve'),(82,7,79,280,'g',NULL,NULL),(83,7,80,65,'g',NULL,NULL),(84,7,41,0.25,'tsp',NULL,NULL),(85,7,81,128,'g',NULL,'melted'),(86,7,22,NULL,'large pinch',NULL,NULL),(87,7,80,100,'g',NULL,NULL),(88,7,82,2.25,'tsp',NULL,NULL),(89,7,47,120,'ml',NULL,NULL),(90,7,83,115,NULL,NULL,'at room temperature'),(91,7,84,850,'g',NULL,NULL),(92,7,22,NULL,'large pinch',NULL,NULL),(93,8,7,400,'g',NULL,NULL),(94,8,85,2,'tbsp',NULL,NULL),(95,8,20,2,'tsp',NULL,NULL),(96,8,86,NULL,'good squeeze',NULL,NULL),(97,8,3,1,NULL,'very thinly sliced into half moons',NULL),(98,8,87,2,'level tsp',NULL,NULL),(99,8,58,20,'g','','finely chopped'),(100,8,27,150,'g',NULL,NULL),(101,8,88,1,'heaped tsp',NULL,NULL),(102,8,14,NULL,NULL,NULL,NULL),(103,8,15,NULL,NULL,NULL,NULL),(104,8,89,500,'g',NULL,'very thinly sliced lengthways'),(105,8,90,2,'tsp',NULL,NULL),(106,8,91,2,'tsp',NULL,NULL),(107,8,98,2,'heaped tsp',NULL,NULL),(108,8,92,2,'tsp',NULL,NULL),(109,8,93,3,'tsp',NULL,NULL),(110,8,15,0.5,'tsp',NULL,NULL),(111,8,94,4,NULL,NULL,NULL),(112,8,95,0.25,NULL,NULL,NULL),(113,8,96,2,NULL,NULL,'sliced into half moons'),(114,8,97,5,NULL,NULL,'thinly sliced (optional)'),(115,9,4,1,'bulb',NULL,NULL),(116,9,99,1,'tbsp',NULL,NULL),(117,9,100,1,'tsp',NULL,NULL),(118,9,101,200,'g',NULL,NULL),(119,9,102,15,'g',NULL,NULL),(120,9,103,50,'g',NULL,'soaked and water reserved'),(121,9,104,0.5,'tsp',NULL,NULL),(122,9,105,1,'tsp',NULL,NULL),(123,9,36,1,'tbsp',NULL,NULL),(124,9,106,200,'g',NULL,NULL),(125,9,17,500,'g',NULL,NULL),(126,9,14,NULL,NULL,NULL,NULL),(127,9,15,NULL,NULL,NULL,NULL),(128,9,107,75,'g',NULL,NULL),(129,10,120,2,'large',NULL,NULL),(130,10,3,1,'medium',NULL,NULL),(131,10,121,2,'sticks','trimmed',NULL),(132,10,122,2,'','peeled',NULL),(133,10,5,500,'g',NULL,NULL),(134,10,4,2,'cloves','peeled and crushed',NULL),(135,10,123,150,'g','wiped and chopped',NULL),(136,10,73,2,'tbsp',NULL,NULL),(137,10,6,150,'ml',NULL,NULL),(138,10,124,200,'ml','made with 1 beef stock cube',NULL),(139,10,7,400,'g',NULL,NULL),(140,10,125,2,'tbsp',NULL,NULL),(141,10,35,1,'heaped tsp',NULL,NULL),(142,10,9,2,NULL,NULL,NULL),(143,10,126,500,'ml',NULL,NULL),(144,10,127,3,'tbsp',NULL,NULL),(145,10,128,NULL,NULL,'','to taste'),(146,10,129,50,'g','grated',NULL),(147,10,18,25,'g','finely grated',NULL),(148,10,130,3,'medium','sliced',NULL),(149,10,15,NULL,NULL,NULL,NULL),(150,11,131,800,'g','gutted, scaled and cut into 2.5cm/1in-thick steaks across the bone.','Alternatively use 800g/1lb 12oz monkfish, sinew removed and chopped into 2.5cm/1in pieces.'),(151,11,14,0.5,'tsp',NULL,'plus extra for seasoning'),(152,11,132,1,'tsp',NULL,NULL),(153,11,133,2,'tbsp',NULL,NULL),(154,11,36,3,'tbsp',NULL,'for frying'),(155,11,3,2,'medium','finely chopped',NULL),(156,11,4,1,'bulb','peeled and pounded in a pestle and mortar',NULL),(157,11,134,0.25,'tsp',NULL,NULL),(158,11,98,1,'heaped tsp',NULL,NULL),(159,11,135,1,'heaped tsp',NULL,NULL),(160,11,136,1,'heaped tsp',NULL,NULL),(161,11,137,450,'ml',NULL,NULL),(162,11,43,1,'handful',NULL,'plus extra leaves to garnish'),(163,11,45,NULL,NULL,'finely chopped','to serve'),(164,11,50,240,'g','cooked according to packed instructions','to serve'),(165,12,3,1,NULL,'thickly sliced',NULL),(166,12,138,4,NULL,NULL,NULL),(167,12,9,1,NULL,NULL,NULL),(168,12,48,900,'ml',NULL,NULL),(169,12,47,600,'ml',NULL,NULL),(170,12,139,900,'g',NULL,NULL),(171,12,140,450,'g',NULL,NULL),(172,12,71,8,NULL,NULL,NULL),(173,12,74,100,'g',NULL,NULL),(174,12,73,90,'g',NULL,NULL),(175,12,58,NULL,'large handful',NULL,NULL),(176,12,141,24,NULL,NULL,NULL),(177,12,128,NULL,NULL,NULL,NULL),(178,12,14,NULL,NULL,NULL,NULL),(179,12,15,NULL,NULL,NULL,NULL),(180,12,142,2.5,'kg','peeled and cut into chunks','such as Maris Piper or King Edward'),(181,12,74,100,'g',NULL,NULL),(182,12,143,2,NULL,NULL,NULL),(183,12,48,250,'ml',NULL,NULL),(184,13,152,225,'g',NULL,NULL),(185,13,59,3,'tbsp',NULL,NULL),(186,13,153,2,NULL,'seeds removed, finely chopped',NULL),(187,13,4,2,'cloves','finely chopped',NULL),(188,13,38,15,'g','finely chopped',NULL),(189,13,154,100,'g',NULL,NULL),(190,13,155,100,'g',NULL,NULL),(191,13,156,200,'g',NULL,NULL),(192,13,157,1,'tbsp',NULL,NULL),(193,13,127,1,'tbsp',NULL,'plus extra for dusting'),(194,13,158,6,NULL,'finely sliced',NULL),(195,13,43,25,'g','finely chopped',NULL),(196,13,25,6,'tbsp',NULL,'for frying'),(197,13,22,NULL,NULL,NULL,NULL),(198,13,15,NULL,NULL,NULL,NULL),(199,13,42,NULL,NULL,'cut into wedges','to serve'),(200,13,43,NULL,NULL,NULL,'to serve'),(201,14,96,500,'g','full-flavoured ','such as Sungold or Gardener\'s Delight'),(202,14,31,2,'tbsp',NULL,NULL),(203,14,159,0,'medium','finely chopped',NULL),(204,14,86,NULL,'sqeeze',NULL,NULL),(205,14,14,NULL,NULL,NULL,NULL),(206,14,15,NULL,NULL,NULL,NULL),(207,14,160,NULL,NULL,NULL,NULL),(208,14,4,NULL,NULL,NULL,NULL),(209,14,57,NULL,NULL,NULL,NULL),(210,14,161,NULL,NULL,NULL,NULL),(211,14,162,NULL,NULL,NULL,NULL),(212,14,16,NULL,NULL,NULL,NULL),(213,15,163,150,'ml',NULL,NULL),(214,15,164,1,'tsp',NULL,NULL),(215,15,165,7,'g','sachet',NULL),(216,15,73,450,'g',NULL,'plus extra for dusting'),(217,15,48,170,'ml',NULL,NULL),(218,15,14,2,'tsp',NULL,NULL),(219,15,74,35,'g','melted',NULL),(220,15,71,1,NULL,NULL,NULL),(221,15,36,1,'tbsp',NULL,'for greasing the tray'),(222,15,71,1,NULL,'beaten','for glazing and sealing'),(223,15,57,2,'tbsp',NULL,NULL),(224,15,3,1,NULL,'finely chopped',NULL),(225,15,4,2,'cloves','crushed',NULL),(226,15,166,200,'g','chopped',NULL),(227,15,167,100,'g','grated',NULL),(228,15,168,1,'tbsp','finely chopped',NULL),(229,15,169,1,'tsp',NULL,NULL),(230,15,22,NULL,NULL,NULL,NULL),(231,15,15,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `step`
--

LOCK TABLES `step` WRITE;
/*!40000 ALTER TABLE `step` DISABLE KEYS */;
INSERT INTO `step` VALUES (1,1,1,'Heat the oil in a large, heavy-based saucepan and fry the bacon until golden over a medium heat. Add the onions and garlic, frying until softened. Increase the heat and add the minced beef. Fry it until it has browned, breaking down any chunks of meat with a wooden spoon. Pour in the wine and boil until it has reduced in volume by about a third. Reduce the temperature and stir in the tomatoes, drained mushrooms, bay leaves, oregano, thyme and balsamic vinegar.',30),(2,1,2,'Either blitz the sun-dried tomatoes in a small blender with a little of the oil to loosen, or just finely chop before adding to the pan. Season well with salt and pepper. Cover with a lid and simmer the Bolognese sauce over a gentle heat for 1-1½ hours until it\'s rich and thickened, stirring occasionally. At the end of the cooking time, stir in the basil and add any extra seasoning if necessary.',90),(3,1,3,'Remove from the heat to \'settle\' while you cook the spaghetti in plenty of boiling salted water (for the time stated on the packet). Drain and divide between warmed plates. Scatter a little parmesan over the spaghetti before adding a good ladleful of the Bolognese sauce, finishing with a scattering of more cheese and a twist of black pepper.',15),(4,2,1,'Put the flour, sugar, baking powder and salt in a bowl and mix thoroughly. Add the milk and vanilla extract and mix with a whisk until smooth.',5),(5,2,2,'Place a large non-stick frying pan over a medium heat. Add 2 teaspoons of the oil and wipe around the pan with a heatproof brush or carefully using a thick wad of kitchen paper.',2),(6,2,3,'Once the pan is hot, pour a small ladleful (around two dessert spoons) of the batter into one side of the pan and spread with the back of the spoon until around 10cm/4in in diameter. Make a second pancake in exactly the same way, greasing the pan with the remaining oil before adding the batter.',10),(7,2,4,'Cook for about a minute, or until bubbles are popping on the surface and just the edges look dry and slightly shiny. Quickly and carefully flip over and cook on the other side for a further minute, or until light, fluffy and pale golden brown. If you turn the pancakes too late, they will be too set to rise evenly. You can always flip again if you need the first side to go a little browner.',2),(8,2,5,'Transfer to a plate and keep warm in a single layer (so they don\'t get squished) on a baking tray in a low oven while the rest of the pancakes are cooked in exactly the same way. Serve with your preferred toppings.',10),(9,3,1,'Preheat the oven to 220C/200C Fan/Gas 7.',1),(10,3,2,'To prepare the topping, put the pepper, courgette, red onion and oil in a bowl, season with lots of black pepper and mix together. Scatter the vegetables over a large baking tray and roast for 15 minutes.',15),(11,3,3,'Meanwhile, make the pizza base. Mix the flour and salt in a large bowl. Add the yoghurt and 1 tablespoon of cold water and mix with a spoon, then use your hands to form a soft, spongy dough. Turn out onto a lightly floured surface and knead for about 1 minute.',5),(12,3,4,'Using a floured rolling pin, roll the dough into a roughly oval shape, approx. 3mm/⅛in thick, turning regularly. (Ideally, the pizza should be around 30cm/12in long and 20cm/8in wide, but it doesn’t matter if the shape is uneven, it just needs to fit onto the same baking tray that the vegetables were cooked on.)',2),(13,3,5,'Transfer the roasted vegetables to a bowl. Slide the pizza dough onto the baking tray and bake for 5 minutes. Take the tray out of the oven and turn the dough over.',5),(14,3,6,'For the tomato sauce, mix the passata with the oregano and spread over the dough. Top with the roasted vegetables, sprinkle with the chilli flakes and then the cheese. Bake the pizza for a further 8–10 minutes, or until the dough is cooked through and the cheese beginning to brown.',10),(15,3,7,'Season with black pepper, drizzle with a slurp of olive oil and, if you like, scatter fresh basil leaves on top just before serving.',2),(16,4,1,'Heat the oil in a non-stick frying pan over a medium heat. Add the onions and stir-fry for 15–18 minutes, or until lightly browned and crispy.',20),(17,4,2,'Put half the onions in a non-metallic mixing bowl with the yoghurt, ginger, garlic, chilli powder, cumin, cardamom, half of the salt, the lime juice, half of the chopped coriander and mint and the green chillies. Stir well to combine. Set aside the remaining coriander and mint for layering the biryani.',2),(18,4,3,'Add the lamb to the mixture and stir to coat evenly. Cover and marinade in the fridge for 6–8 hours, or overnight if possible.',360),(19,4,4,'Preheat the oven to 240C/Fan 220C/Gas 9.',1),(20,4,5,'Heat the cream and milk in a small saucepan, add the saffron, remove from the heat and leave to infuse for 30 minutes.',35),(21,4,6,'Cook the rice in a large saucepan in plenty of boiling water with the remaining salt for 6–8 minutes, or until it is just cooked, but still has a bite. Drain the rice.',8),(22,4,7,'Spread half of the lamb mixture evenly in a wide, heavy-based casserole and cover with a layer of half the rice. Sprinkle over half of the reserved onions and half of the reserved coriander and mint. Sprinkle over half of the saffron mixture. Repeat with the remaining lamb, rice, onions, herbs and saffron mixture.',5),(23,4,8,'Cover with a tight fitting lid, turn down the oven to 200C/Fan 180C/Gas 6 and cook for 1 hour. Remove and allow to stand for 15–20 minutes before serving. Garnish with pomegranate seeds if desired.',80),(24,5,1,'In a large bowl mix all the ingredients together except the rocket, then taste and adjust the seasoning, adding more salt if necessary. Toss in the rocket and serve immediately.',5),(25,6,1,'Preheat the oven to 180C/350F/Gas 4.',1),(26,6,2,'Pour the milk, cream and vanilla into a pan and boil for a minute. Remove from the heat and set aside to cool.',5),(27,6,3,'Tip the eggs and sugar into a bowl and beat together until light and fluffy. Fold the flour into the mixture, a little at a time.',5),(28,6,4,'Pour the cooled milk and cream onto the egg and sugar mixture, whisking lightly. Set aside.',3),(29,6,5,'Place a little butter into an ovenproof dish and heat in the oven until foaming. Add the plums and brown sugar and bake for 5 minutes, then pour the batter into the dish and scatter with flaked almonds, if using.',20),(30,6,6,'Cook in the oven for about 30 minutes, until golden-brown and set but still light and soft inside.',30),(31,6,7,'Dust with icing sugar and serve immediately with cream.',2),(32,7,1,'To make the biscuit base, finely crush the biscuits by putting into a sealed plastic bag and bashing with a rolling pin (alternatively, pulse to crumbs using a food processor). Transfer to a mixing bowl and add the sugar, cardamom and salt, stirring well to combine.',5),(33,7,2,'Pour the melted butter over the biscuit crumbs and mix, until thoroughly combined. Put half the crumb mixture in a 23cm/9in metal pie tin, and press evenly with your fingers. Build up the sides of the tin, compressing the base as much as possible to prevent it crumbling. Repeat with the rest of the mixture in the second tin.',5),(34,7,3,'Preheat the oven to 160C/325F/Gas 3. Put the pie bases in the freezer for 15 minutes. Remove and bake for 12 minutes, or until golden brown. Transfer to a wire rack to cool.',3),(35,7,4,'To make the filling, pour 177ml/6fl oz of cold water into a large bowl. In a separate bowl, mix the gelatine with half the sugar and sprinkle over the water. Leave to stand for a couple of minutes.',2),(36,7,5,'Meanwhile, whip the cream with the remaining sugar to form medium stiff peaks. Set aside.',3),(37,7,6,'Heat about a quarter of the mango pulp in a saucepan over a medium-low heat, until just warm. Make sure you do not boil it. Pour into the gelatine mixture and whisk, until well combined. The gelatine should dissolve completely. Gradually whisk in the remaining mango pulp.',3),(38,7,7,'Beat the cream cheese in a bowl, until soft and smooth. Add to the mango mixture with the salt. Blend the mixture using a hand blender, until completely smooth. Gently tap the bowl on the kitchen counter once or twice to pop any air bubbles.',3),(39,7,8,'Fold about a quarter of the mango mixture into the whipped cream using a spatula. Repeat with the rest of the cream, until no streaks remain.',3),(40,7,9,'Divide the filling between the cooled bases, using a rubber spatula to smooth out the filling. Refrigerate overnight, or for at least 5 hours, until firm and chilled.',5),(41,8,1,'Preheat the oven to 180C/200C Fan/Gas 4.',1),(42,8,2,'To make the chilli sauce, heat the chopped tomatoes, rose harissa, sugar and lemon juice in a small saucepan over a medium heat. Bring to a gentle boil and cook for 10 minutes, stirring regularly, until reduced to a thick sauce-like consistency. Remove from the heat and set aside to cool. You can blend the sauce until it’s smooth using a hand-blender if you like, or just leave it chunky.',15),(43,8,3,'For the onion, mix together the onion slices, vinegar and parsley and set aside.',3),(44,8,4,'To make the yoghurt sauce, mix the yoghurt with the dried mint, season with salt and pepper and set aside.',2),(45,8,5,'Put the pittas in the oven to warm for 5 minutes.',5),(46,8,6,'To make the \'doner\', heat a frying pan over a medium-high heat. Add the mushrooms and dry-fry for 2 minutes, stirring once or twice. Add the garlic oil, paprika, coriander, celery salt, garlic granules and black pepper and quickly coat the mushrooms. Add 2–3 tablespoons of water to the pan and stir-fry for 1 minute before removing from the heat.',5),(47,8,7,'Split the warmed pitta breads. Spoon a little white cabbage into each pitta and add a little tomato and onion. Divide the mushrooms between the pittas, add a little more cabbage and tomato, then drizzle with the chilli and yoghurt sauces. Serve immediately, topped with the pickled chillies, if using.',5),(48,9,1,'Preheat the oven to 200C/180C Fan/Gas 6.',1),(49,9,2,'Cut the top off the garlic bulb, cover with the truffle oil and smoked salt and wrap in kitchen foil. Place in a small roasting tin and roast for around 30–40 minutes. Leave to cool slightly.',35),(50,9,3,'To make the sauce, squeeze the roasted garlic into a blender or food processor with the silken tofu, nutritional yeast, cashew nuts, black salt and miso paste. Add some of the water from the soaked cashews just to loosen and blitz to a sauce. Add more water if needed.',5),(51,9,4,'Fry the vegan bacon in the oil in a frying pan until crispy. Remove from the pan and set aside.',15),(52,9,5,'Cook the pasta in a saucepan of boiling salted water according to the packet instructions. Drain, reserving the pasta cooking water.',12),(53,9,6,'Return the pasta to the pan and add the sauce and half of the vegan bacon. Add at least 1 ladle of the pasta water to loosen, adding more pasta water if needed.',2),(54,9,7,'Serve with black pepper, vegan hard cheese and the remaining vegan bacon. Enjoy!',2),(55,10,1,'Trim the leeks until they are about the same width as your lasagne dish. Cut the leeks lengthways through to the middle but no further.',2),(56,10,2,'Open out the leeks and remove five or six of the narrow leaves from the centre of each leek. Thinly slice these inner leaves. Separate the larger leaves – these will become your ‘lasagne’.',2),(57,10,3,'Finely chop half the onion and cut the other half into wedges. Thinly slice the celery and dice the carrots.',5),(58,10,4,'Put the minced beef in a large non-stick frying pan with the sliced leeks, chopped onion, celery, carrots and garlic.',1),(59,10,5,'Place the pan over a medium-high heat and fry without added fat for about 10 minutes until lightly coloured. You’ll need to break up the mince with a couple of wooden spatulas or spoons as it cooks.',10),(60,10,6,'Stir in the chopped mushrooms and cook for 2–3 minutes more. The pan should look fairly dry at this point.',3),(61,10,7,'Sprinkle over the plain flour and stir it thoroughly into the mince and vegetables. Slowly stir in the red wine and beef stock. Add the canned tomatoes, tomato purée and dried oregano, then drop a bay leaf into the pan and bring it to a simmer. Season with lots of freshly ground black pepper.',2),(62,10,8,'Turn down the heat slightly and leave the mince to simmer for 20–30 minutes until rich and thick, stirring occasionally.',25),(63,10,9,'While the mince is cooking, put the onion wedges in a saucepan with the remaining bay leaf. In a small bowl mix three tablespoons of the milk with the cornflour.',1),(64,10,10,'Pour the rest of the milk into the pan with the onion wedges and set it over a low heat. Bring to a very gentle simmer and cook for 2–3 minutes. Remove from the heat and leave the milk to infuse for 10 minutes.',5),(65,10,11,'Half fill a large saucepan with water and bring to the boil. Add the leek ‘lasagne’ and bring the water back to the boil.',5),(66,10,12,'Cook the leeks for five minutes or until very tender. It is important that the leeks are tender or the lasagne will be tricky to cut later.',5),(67,10,13,'Drain in a colander under running water until cold. Drain on kitchen paper or a clean tea towel.',2),(68,10,14,'Preheat the oven to 200C/400F/Gas 6.',1),(69,10,15,'Remove the onion wedges and bay leaf from the infused milk with a slotted spoon, then return the pan to the heat. Give the cornflour and milk mixture a good stir until it is smooth once more and pour it into the pan with the infused milk.',2),(70,10,16,'Bring to a simmer and cook for five minutes, stirring regularly until the sauce is smooth and thick.',5),(71,10,17,'Season the sauce with a good grating of nutmeg to taste and plenty of ground black pepper.',1),(72,10,18,'If the sauce is a little too thick to pour easily, whisk in a couple more tablespoons of milk.',18),(73,10,19,'Spoon a third of the mince mixture into a 2.5 litre lasagne dish. Top with a layer of blanched leeks. Repeat the layers twice more, finishing with leeks. Pour the white sauce over the leeks and top with the sliced tomatoes. Mix the cheddar and parmesan cheese and sprinkle all over the top. Bake for 30 minutes or until golden-brown and bubbling.',35),(74,10,20,'Divide into portions with your sharpest knife. Serve with a freshly dressed green salad.',2),(75,11,1,'Put the fish steaks in a large bowl. Sprinkle with salt and half the turmeric and mix together, making sure the fish is well coated. Set aside to marinade for a few minutes.',10),(76,11,2,'Heat a small frying pan over a high heat and fry the mustard seeds for 1–2 minutes until lightly toasted and fragrant and beginning to pop. Tip into a pestle and mortar and pound until finely ground, then set aside.',2),(77,11,3,'Heat a large non-stick pan over a medium heat and add the vegetable oil. Once hot, tip in the onions and fry for 8–10 minutes over a medium-low heat until starting to colour. Season with salt and continue to cook for a few more minutes until lightly golden.',10),(78,11,4,'Add the pounded garlic to the pan and cook for 2 minutes, stirring constantly before adding the remaining half teaspoon turmeric, chilli powder, ground coriander, garam masala and paprika. Mix together and stir over a low heat for a further 2–3 minutes. When the mixture gets dryer, add 250ml/9fl oz boiling water to loosen and cook for a minute before adding 2 heaped teaspoons of the pounded mustard seeds (reserve the rest for another usage). Allow to cook gently for 3-4 minutes while stirring.',10),(79,11,5,'Wash the fish by rinsing well with cold water. Then add to the pan along with enough hot water to cover the fish (approximately 150–200ml/5½–7fl oz). Swirl the pan to cover the fish in the sauce. Cook gently for around 6–8 minutes, carefully turning the fish halfway through cooking. The curry is ready when the fish is opaque and cooked through and the sauce has started to thicken (it should have a loose consistency). Add the freshly chopped coriander and season to taste with salt.',8),(80,11,6,'Heat for another minute, don’t stir the pan as this might break up the fish – just give the pan a gentle swirl or shake. Serve the fish curry with sliced green chilli, extra coriander leaves and basmati rice.',3),(81,12,1,'Put the onion slices, cloves and bay leaf in a large pan with the milk, cream, pollock and smoked haddock. Bring just to the boil, then turn down and simmer for 8 minutes. Using a slotted spoon, lift the fish out onto a plate and strain the cooking liquor into a jug.',10),(82,12,2,'Boil the eggs for 8 minutes, then drain and leave to cool.',10),(83,12,3,'When the fish is cool enough to handle, break it into large flakes, discarding the skin and bones. Put the fish into a shallow 3.5 litre/6 pint ovenproof dish.',3),(84,12,4,'Peel the hard-boiled eggs, cut them into chunky slices and arrange on top of the fish.',5),(85,12,5,'Melt the butter in a pan, stir in the flour and cook for 1 minute. Take the pan off the heat and gradually stir in the reserved cooking liquor. Return the pan to the heat and bring slowly to the boil, stirring all the time. Leave to simmer gently for 10 minutes. Remove from the heat, stir in the parsley and prawns and season with nutmeg, salt and white pepper. Pour the sauce over the fish and leave to cool. Chill in the fridge for 1 hour.',12),(86,12,6,'To make the topping, boil the potatoes for 15–20 minutes until tender. Drain and place in a wide mixing bowl. Mash the potatoes with an electric hand mixer until no lumps remain, then add the butter and egg yolks, season with salt and freshly ground white pepper and beat in enough of the milk to form a soft, spreadable mash.',20),(87,12,7,'Preheat the oven to 200C/180C Fan/Gas 6. Spoon the mashed potato over the fish mixture and mark the surface with a fork. Bake for 35–40 minutes, until piping hot and golden brown.',45),(88,13,1,'For the chilli jam dipping sauce, put the sugar, vinegar and 100ml/3½fl oz water in a small saucepan and gently heat until the sugar dissolves, stirring constantly. Add the chilli, garlic and ginger and bring to the boil. Cook for three minutes. Remove from the heat and pour into two heatproof serving bowls. It will thicken as it cools. (Any leftover chilli jam can be covered and kept in the fridge for up to two weeks.)',5),(89,13,2,'To make the crab cakes, put the crab meat, prawns, curry paste, cornflour and a couple of really good pinches of flaked sea salt and a few twists of ground black pepper into a food processor. Blend until well combined. You may need to remove the lid and push the mixture down a couple of times with a rubber spatula. Don’t allow the mixture to become too thin or smooth or it will be difficult to shape into crab cakes.',2),(90,13,3,'Remove the blade and transfer the mixture to a large bowl. Stir in the spring onions and coriander until evenly mixed. Sprinkle a small tray or platter with the extra tablespoon of cornflour.',1),(91,13,4,'Wet your hands under the cold tap to stop the crab cakes from sticking. Take a small handful of the mixture – about the size of a golfball. Roll into a neat ball then flatten until around 1.5cm/¾in thick and 6cm/2½in in diameter. Place on the cornflour-dusted tray. Continue rolling and flattening the mixture until you have made 12 crab cakes.',10),(92,13,5,'Pour the oil into a large non-stick frying pan and place over a medium heat. When the oil is hot, add six of the crab cakes and cook for two minutes on each side or until lightly browned and cooked throughout. Transfer to a warmed plate while the rest are cooked.',10),(93,13,6,'Divide the crab cakes between two large plates or small platters. Add a dish of the chilli jam to each one and garnish with lime wedges and sprigs of fresh coriander to serve.',2),(94,14,1,'Put the tomatoes in a bowl and cover with boiling water. Remove the tomatoes after 30 seconds then peel them using a sharp knife. Cut into quarters and scoop out the seeds.',1),(95,14,2,'You are left with skinless, seedless, delectably sweet tomato flesh. This can be left in quarters (for a chunky, salady version) or more finely chopped (if you are tending towards the salsa). Either way, toss with the remaining ingredients and it is ready to serve.',1),(96,14,3,'For the bruschetta, grill slices of ciabatta or pugliese bread, rub with garlic and drizzle with olive oil. You can use the tomato salsa as it is, or mix it with a few chopped black olives, and/or a couple of chopped anchovies and/or a few torn fresh basil leaves. Pile on to the bread and serve as a starter, either on its own or with other antipasti.',5),(97,15,1,'First make your starter mixture for the dough. Pour the lukewarm water into a bowl, add the sugar and yeast, then stir in 100g/3½oz of the flour. Mix well and leave the mixture to rise for 2–3 hours.',120),(98,15,2,'Add the milk, salt, the rest of the flour, and the butter and egg then knead the mixture into a relatively firm dough. Leave it to rise for 2 hours.',120),(99,15,3,'Meanwhile, make the filling. Heat the olive oil in a frying pan, add the onion and cook gently for about five minutes until translucent. Add the garlic and continue to cook for another two minutes. Stir in the ham, cheese, parsley and caraway seeds, then season to taste and set aside to cool.',10),(100,15,4,'Preheat the oven to 200C/400F/Gas 6.',1),(101,15,5,'Roll out the dough thinly on a floured surface and cut out 12 small circles. Use a glass if you don’t have a pastry cutter. Place a spoonful of filling on to one half of a pastry circle, then brush the edges with the beaten egg, and fold the pastry over to enclose the filling. Squeeze the edges together and brush again with the beaten egg. Fill the rest of the circles in the same way.',5),(102,15,6,'Place the pies on a greased baking tray and bake them for 12–15 minutes until golden.',15);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip`
--

LOCK TABLES `tip` WRITE;
/*!40000 ALTER TABLE `tip` DISABLE KEYS */;
INSERT INTO `tip` VALUES (1,1,1,'You can make a veggie version of this recipe by substituting soya mince or Quorn for the meat, adding it to the sauce halfway through cooking.'),(2,1,2,'Or simply add lots of diced vegetables to the onions, such as courgettes, carrots, peppers and aubergines.'),(3,2,1,'Whipped coconut cream is good with these too, but it must be well chilled before whipping.'),(4,2,2,'You can keep the pancakes warm in a low oven while you make the full batch.'),(5,3,1,'You can use any cheese you like for this pizza – it’s also a great way to use up a mix of odds and ends from the fridge.'),(6,3,2,'Make two pizzas instead of one large pizza if you like.'),(7,3,3,'Any leftover passata can be used for pasta sauces, stews or curries. It freezes well for up to 4 months. Instead of passata, you can use a bought pizza topping or strained tinned tomatoes.'),(8,3,4,'If you don’t have self-raising wholemeal flour, use plain wholemeal flour and add 1 teaspoon of baking powder and an extra tablespoon of water if needed.'),(9,4,1,'Kashmiri red chilli powder is quite mild with a slightly smoky flavour that really adds to the dish.'),(10,5,1,'Couscous salads are great to make ahead for easy entertaining or weekday lunches. It will keep well for a few days in the fridge.'),(11,7,1,'This recipe makes two pies, so halve the ingredients if you\'re not feeding a crowd.'),(12,11,1,'It\'s best to ask your fish supplier to prepare the rohu into 2.5cm/1in steaks though the bone. If preparing the rohu yourself, allow the fish to defrost before removing the scales with the back of a spoon, then remove the fins and tail using a sharp knife. Cut into steaks across the bone using a heavy knife. Allow to defrost completely before cooking.'),(13,14,1,'Ideally bruschetta should be served when the bread is freshly toasted and warm, and the toppings cold.');
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

-- Dump completed on 2024-03-18 17:52:45
