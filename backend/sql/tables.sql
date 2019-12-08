-- Structure for table 'node_tree'

CREATE TABLE node_tree (
  idNode int(11) NOT NULL,
  level int(11) NOT NULL,
  iLeft int(11) NOT NULL,
  iRight int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Structure for table 'node_tree_names'

CREATE TABLE node_tree_names (
  idNode int(11) NOT NULL,
  language varchar(45) DEFAULT NULL,
  nodaName varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
