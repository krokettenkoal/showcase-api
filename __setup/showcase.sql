-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: showcase
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `StudyProgramId` int NOT NULL,
  `Title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Subtitle` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `MoodleUrl` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_COURSES_STUDYPROGRAMID_idx` (`StudyProgramId`),
  CONSTRAINT `FK_COURSES_STUDYPROGRAMID` FOREIGN KEY (`StudyProgramId`) REFERENCES `studyprograms` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1,'UIP','User Interface Programming',NULL),(2,2,'IWT','Introduction to Web Technologies',NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examples`
--

DROP TABLE IF EXISTS `examples`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examples` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `SessionId` int NOT NULL,
  `Title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Icon` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Component` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_EXAMPLES_SESSIONID` (`SessionId`),
  CONSTRAINT `FK_EXAMPLES_SESSIONID` FOREIGN KEY (`SessionId`) REFERENCES `sessions` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examples`
--

LOCK TABLES `examples` WRITE;
/*!40000 ALTER TABLE `examples` DISABLE KEYS */;
INSERT INTO `examples` VALUES (1,1,'Click counter','A simple click counter','exposure_plus_1','counter.jpg','Counter'),(2,1,'PIN','A simple PIN code, as seen on a phone lock screen','dialpad','pin.webp','PinLock'),(3,1,'To-do','A (very) basic to-do list','checklist','todo.jpg','Todo');
/*!40000 ALTER TABLE `examples` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `CourseId` int NOT NULL,
  `Title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`) USING BTREE,
  KEY `FK_SESSIONS_COURSEID` (`CourseId`),
  CONSTRAINT `FK_SESSIONS_COURSEID` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (1,1,'Lecture 1','Introduction','hello.jpg','2023-09-23 00:00:00');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sources`
--

DROP TABLE IF EXISTS `sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sources` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `ExampleId` int NOT NULL,
  `SourceTypeId` int NOT NULL,
  `Title` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Priority` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `FK_SOURCES_EXAMPLEID` (`ExampleId`),
  KEY `FK_SOURCES_SOURCETYPEID` (`SourceTypeId`),
  CONSTRAINT `FK_SOURCES_EXAMPLEID` FOREIGN KEY (`ExampleId`) REFERENCES `examples` (`Id`),
  CONSTRAINT `FK_SOURCES_SOURCETYPEID` FOREIGN KEY (`SourceTypeId`) REFERENCES `sourcetypes` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sources`
--

LOCK TABLES `sources` WRITE;
/*!40000 ALTER TABLE `sources` DISABLE KEYS */;
INSERT INTO `sources` VALUES (1,1,1,NULL,'<script>\r\n    let counter = 0;\r\n</script>\r\n\r\n<button on:click={() => counter = Math.max(0, counter - 1)}>-</button>\r\n<span>{counter}</span>\r\n<button on:click={() => counter++}>+</button>',0),(2,1,3,NULL,'<script>\r\n  function increment(){\r\n      let count = document.querySelector(\'#count\');\r\n      count.innerText = parseInt(count.innerText) + 1;\r\n  }\r\n  function decrement(){\r\n      let count = document.querySelector(\'#count\');\r\n      count.innerText = Math.max(0, parseInt(count.innerText) - 1);\r\n  }\r\n</script>\r\n\r\n<button onclick=\"decrement()\">-</button>\r\n<span id=\"count\">0</span>\r\n<button onclick=\"increment()\">+</button>',0),(3,2,1,NULL,'<div class=\"code-display\">{\'*\'.repeat(entered.length) || result || \'PIN\'}</div>\r <div class=\"numpad\">\r     {#each Array(10) as _, i}\r         <button on:click={() => enter(i)}>{i}</button>\r     {/each}\r </div>\r <script>\r     const pin = \'4269\';\r     let entered = \'\', result = \'\';\r     function enter(num){\r         entered += num;\r         if(entered.length === pin.length){\r             result = entered === pin ? \':)\' : \':(\';\r             entered = \'\';\r             return;\r         }\r         result = \'\';\r     }\r </script>',0),(4,2,3,NULL,'<div id=\"display\">Enter PIN</div>\r\n<div id=\"buttons\"></div>\r\n<script>\r\n    const pin = \'4269\';\r\n    let entered = \'\';\r\n    createButtons();\r\n    function createButtons(){\r\n        for(let i = 0; i < 10; i++){\r\n            const button = document.createElement(\'button\');\r\n            button.innerText = i;\r\n            button.onclick = () => enter(i);\r\n            document.querySelector(\"#buttons\").appendChild(button);\r\n        }\r\n    }\r\n    function enter(num){\r\n        entered += num;\r\n        const display = document.querySelector(\"#display\");\r\n        if(entered.length === pin.length){\r\n            display.innerText = entered === pin ? \'correct\' : \'incorrect\';\r\n            entered = \'\';\r\n            return;\r\n        }\r\n        display.innerText = \'*\'.repeat(entered.length);\r\n    }\r\n</script>',0),(5,3,1,NULL,'<script lang=\"ts\">\r\n    import IconButton from \"@smui/icon-button\";\r\n    import TextField from \"@smui/textfield\";\r\n    import List, {Item, Text} from \"@smui/list\";\r\n\r\n    let todos: string[] = [], newTodo: string = \'\';\r\n    function addTodo(){\r\n        todos.push(newTodo);\r\n        todos = todos;\r\n        newTodo = \'\';\r\n    }\r\n</script>\r\n\r\n<div class=\"todo-list\">\r\n    <List class=\"todos\" nonInteractive>\r\n        {#each todos as todo}\r\n            <Item class=\"todo\">\r\n                <TextField bind:value={todo} />\r\n            </Item>\r\n        {:else}\r\n            <Item>\r\n                <Text>Nothing to do! ?</Text>\r\n            </Item>\r\n        {/each}\r\n    </List>\r\n    <div class=\"new-todo\">\r\n        <TextField type=\"text\" bind:value={newTodo} class=\"todo\" label=\"To-do\" />\r\n        <IconButton on:click={addTodo} class=\"material-icons\">add</IconButton>\r\n    </div>\r\n</div>\r\n\r\n<style>\r\n    .new-todo {\r\n        display: flex;\r\n        align-items: center;\r\n    }\r\n</style>',0),(6,3,2,NULL,'import React, { useState } from \"react\";\r\n\r\nfunction TodoApp() {\r\n    const [todo, setTodo] = useState(\"\");\r\n    const [todos, setTodos] = useState([]);\r\n\r\n    function handleAddTodo() {\r\n        setTodos([...todos, todo]);\r\n        setTodo(\"\");\r\n    }\r\n\r\n    return (\r\n        <div>\r\n            <input value={todo} onChange={(e) => setTodo(e.target.value)} />\r\n            <button onClick={handleAddTodo}>Add</button>\r\n            <ul>\r\n                {todos.map((t) => (\r\n                    <li key={t}>{t}</li>\r\n                ))}\r\n            </ul>\r\n        </div>\r\n    );\r\n}\r\n\r\nexport default TodoApp;',0),(7,3,3,NULL,'<script>\r\n    function addTodo(){\r\n        let todo = document.querySelector(\'input#new-todo\');\r\n        let li = document.createElement(\'li\');\r\n        li.innerText = todo.value;\r\n        todo.value = \'\';\r\n        document.querySelector(\'ul#todos\').appendChild(li);\r\n    }\r\n</script>\r\n<ul id=\"todos\"></ul>\r\n<input id=\"new-todo\" type=\"text\" />\r\n<button onclick=\"addTodo()\">Add</button>\r\n',0);
/*!40000 ALTER TABLE `sources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sourcetypes`
--

DROP TABLE IF EXISTS `sourcetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sourcetypes` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Icon` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Language` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sourcetypes`
--

LOCK TABLES `sourcetypes` WRITE;
/*!40000 ALTER TABLE `sourcetypes` DISABLE KEYS */;
INSERT INTO `sourcetypes` VALUES (1,'Svelte','ciSvelte',''),(2,'React','faReact','javascript'),(3,'HTML/JS','faHtml5',NULL),(4,'JavaScript','faSquareJs','javascript'),(5,'TypeScript','ciTypeScript','typescript'),(6,'CSS','faCss3','css'),(7,'HTML','faHtml5',NULL);
/*!40000 ALTER TABLE `sourcetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studyprograms`
--

DROP TABLE IF EXISTS `studyprograms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studyprograms` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Subtitle` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Title_UNIQUE` (`Title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studyprograms`
--

LOCK TABLES `studyprograms` WRITE;
/*!40000 ALTER TABLE `studyprograms` DISABLE KEYS */;
INSERT INTO `studyprograms` VALUES (1,'BMT','Media Technology'),(2,'BCC','Creative Computing');
/*!40000 ALTER TABLE `studyprograms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-03  9:55:36
