# GREWordDatabase
A simple web page to record and search words. Used to help spell words.

Database table structure:

CREATE TABLE word(
  word_id INT UNSIGNED AUTO_INCREMENT,
  word VARCHAR(25) NOT NULL,
  explanation VARCHAR(1000),
  submission_date DATETIME NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'creation time',
  PRIMARY KEY (word_id)
);
