
-- Populate table node_tree

INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 1, 2, 2, 3 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 2, 2, 4, 5 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 3, 2, 6, 7 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 4, 2, 8, 9 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 5, 1, 1, 24 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 6, 2, 10, 11 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 7, 2, 12, 19 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 8, 3, 15, 16 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 9, 3, 17, 18 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 10, 2, 20, 21 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 11, 3, 13, 14 );
INSERT INTO node_tree ( idNode, level, iLeft, iRight ) VALUES( 12, 2, 22, 23 );

-- Populate table node_tree_names

INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 1, "english", "Marketing" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 1, "italian", "Marketing" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 2, "english", "Helpdesk" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 2, "italian", "Supporto tecnico" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 3, "english", "Managers" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 3, "italian", "Managers" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 4, "english", "Customer Account" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 4, "italian", "Assistenza Cliente" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 5, "english", "Docebo" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 5, "italian", "Docebo" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 6, "english", "Accounting" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 6, "italian", "Amministrazione" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 7, "english", "Sales" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 7, "italian", "Supporto Vendite" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 8, "english", "Italy" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 8, "italian", "Italia" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 9, "english", "Europe" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 9, "italian", "Europa" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 10, "english", "Developers" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 10, "italian", "Sviluppatori" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 11, "english", "North America" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 11, "italian", "Nord America" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 12, "english", "Quality Assurance" );
INSERT INTO node_tree_names ( idNode, language, nodaName ) VALUES( 12, "italian", "Controllo Qualità" );

COMMIT;
