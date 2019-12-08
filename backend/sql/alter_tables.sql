-- Add primary key for 'node_tree'

ALTER TABLE node_tree ADD PRIMARY KEY ( idNode );

-- Add auto increment for 'node_tree' primary key

ALTER TABLE node_tree MODIFY idNode int(11) NOT NULL AUTO_INCREMENT;

-- Set auto increment to 1 for primary key in 'node_tree'

ALTER TABLE node_tree AUTO_INCREMENT = 1;

-- Add primary key for 'node_tree_names'

ALTER TABLE node_tree_names ADD PRIMARY KEY ( idNode, language );

-- Add foreign key for 'node_tree_names'
ALTER TABLE node_tree_names
  ADD CONSTRAINT idNode
  FOREIGN KEY ( idNode )
  REFERENCES node_tree ( idNode )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

COMMIT;
