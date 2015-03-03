INSERT INTO grape (grape_name, color) VALUES
('Cabernet savignon', 'red'),
('Merlot', 'red'),
('Zinfandel', 'red'),
('Pinot Noir', 'red'),
('Savignon Blanc', 'white'),
('Syrah', 'red'),
('Chardonnay', 'white'),
('Riesling', 'white'),
('Malbec', 'red');


INSERT INTO flavors (flavor, description) VALUES
('acidic' , 'acid flavor'),
('buttery', 'rich, creamy mouthfeel with flavors reminiscent of butter'),
('cloying', 'sticky or sickly sweet character that is not balanced with acidity'),
('jammy', 'rich in fruit but maybe lacking in tannins'),
('oaky', 'noticeable perception of the effects of oak. This can include the sense of vanilla, sweet spices like nutmeg, a creamy body and a smoky or toasted flavor'),
('tannic', 'aggressive tannins');

INSERT INTO grape_flavor (grape_id, flavor_id) VALUES
(3, 4),
(7, 2);

INSERT INTO food (food_item) VALUES
('Lamb'),
('Steak'),
('Duck'),
('Blue Cheese'),
('Pizza'),
('Hamburger'),
('Chicken'),
('Shellfish'),
('Sausage'),
('Salmon'),
('Pork');

INSERT INTO grape_food (grape_id, food_id) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(5, 8),
(6, 1),
(6, 2),
(6, 9),
(7, 10),
(7, 7),
(8, 10),
(8, 11),
(9, 2),
(9, 1);



