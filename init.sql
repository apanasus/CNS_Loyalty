CREATE TABLE users (
                       id INT PRIMARY KEY AUTO_INCREMENT,
                       username VARCHAR(50) NOT NULL
);

CREATE TABLE groups (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(50) NOT NULL
);

CREATE TABLE permissions (
                             id INT PRIMARY KEY AUTO_INCREMENT,
                             name VARCHAR(50) NOT NULL
);

CREATE TABLE group_permissions (
                                   group_id INT,
                                   permission_id INT,
                                   FOREIGN KEY (group_id) REFERENCES groups(id),
                                   FOREIGN KEY (permission_id) REFERENCES permissions(id),
                                   PRIMARY KEY (group_id, permission_id)
);

CREATE TABLE user_groups (
                             user_id INT,
                             group_id INT,
                             FOREIGN KEY (user_id) REFERENCES users(id),
                             FOREIGN KEY (group_id) REFERENCES groups(id),
                             PRIMARY KEY (user_id, group_id)
);

CREATE TABLE user_temporarily_blocked (
                                          user_id INT,
                                          permission_id INT,
                                          FOREIGN KEY (user_id) REFERENCES users(id),
                                          FOREIGN KEY (permission_id) REFERENCES permissions(id),
                                          PRIMARY KEY (user_id, permission_id)
);
