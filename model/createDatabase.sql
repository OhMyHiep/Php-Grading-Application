CREATE DATABASE `capstone` /*!40100 DEFAULT CHARACTER SET utf8mb4 */

CREATE TABLE `Answers` (
  `answer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Uploaded_Assignment_ID` int(11) DEFAULT NULL,
  `choice_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`answer_ID`),
  KEY `Uploaded_Assignment_ID` (`Uploaded_Assignment_ID`),
  KEY `choice_ID` (`choice_ID`),
  CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`choice_ID`) REFERENCES `Choices` (`Choice_ID`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`Uploaded_Assignment_ID`) REFERENCES `Uploaded_Assignment` (`uploaded_assignment_ID`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Choices` (
  `Choice_ID` int(11) NOT NULL AUTO_INCREMENT,
  `question_ID` int(11) DEFAULT NULL,
  `grade` int(10) NOT NULL,
  `statement` varchar(20) NOT NULL,
  PRIMARY KEY (`Choice_ID`),
  KEY `question_ID` (`question_ID`),
  CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`question_ID`) REFERENCES `RubricQuestions` (`question_ID`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Created_Assignments` (
  `created_assignment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `teacher_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`created_assignment_ID`),
  KEY `teacher_ID` (`teacher_ID`),
  CONSTRAINT `created_assignments_ibfk_1` FOREIGN KEY (`teacher_ID`) REFERENCES `Teacher` (`teacher_ID`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Login` (
  `login_ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`login_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `RubricQuestions` (
  `question_ID` int(11) NOT NULL AUTO_INCREMENT,
  `created_assignment_ID` int(11) NOT NULL,
  `question_number` int(11) DEFAULT NULL,
  `Question_statement` text DEFAULT NULL,
  PRIMARY KEY (`question_ID`),
  KEY `created_assignment_ID` (`created_assignment_ID`),
  CONSTRAINT `rubricquestions_ibfk_1` FOREIGN KEY (`created_assignment_ID`) REFERENCES `Created_Assignments` (`created_assignment_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Student` (
  `student_ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `login_ID` int(11) DEFAULT NULL,
  `userType` varchar(20) NOT NULL,
  PRIMARY KEY (`student_ID`),
  KEY `login_ID` (`login_ID`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`login_ID`) REFERENCES `Login` (`login_ID`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `Teacher` (
  `teacher_ID` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `login_ID` int(10) DEFAULT NULL,
  `userType` varchar(20) NOT NULL,
  PRIMARY KEY (`teacher_ID`),
  KEY `Login_ID` (`login_ID`),
  CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`Login_ID`) REFERENCES `Login` (`login_ID`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`login_ID`) REFERENCES `Login` (`login_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Uploaded_Assignment` (
  `uploaded_assignment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `peer_grade` int(11) DEFAULT NULL,
  `peer_ID` int(11) DEFAULT NULL,
  `student_ID` int(11) DEFAULT NULL,
  `created_assigment_ID` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uploaded_assignment_ID`),
  KEY `created_assigment_ID` (`created_assigment_ID`),
  KEY `student_ID` (`student_ID`),
  KEY `peer_ID` (`peer_ID`),
  CONSTRAINT `uploaded_assignment_ibfk_1` FOREIGN KEY (`student_ID`) REFERENCES `Student` (`student_ID`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `uploaded_assignment_ibfk_2` FOREIGN KEY (`created_assigment_ID`) REFERENCES `Created_Assignments` (`created_assignment_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

