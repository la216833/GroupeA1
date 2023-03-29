<?php
use CashRegister\core\database\DBConnection;

class m0011_salesContent {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO salesContent (salesID, productsID) VALUES 
            (432, 97),
            (758, 22),
            (845, 45),
            (674, 79),
            (720, 70),
            (694, 33),
            (274, 50),
            (626, 59),
            (285, 84),
            (205, 61),
            (827, 82),
            (274, 18),
            (957, 43),
            (232, 64),
            (251, 92),
            (684, 82),
            (120, 19),
            (294, 26),
            (311, 29),
            (733, 85),
            (471, 43),
            (47, 2),
            (703, 80),
            (46, 64),
            (691, 49),
            (792, 10),
            (822, 38),
            (735, 13),
            (56, 46),
            (748, 99),
            (300, 93),
            (158, 31),
            (341, 76),
            (111, 90),
            (361, 60),
            (318, 11),
            (337, 36),
            (629, 94),
            (807, 33),
            (752, 76),
            (769, 86),
            (386, 96),
            (206, 86),
            (104, 75),
            (631, 61),
            (808, 29),
            (649, 82),
            (968, 29),
            (379, 86),
            (611, 44),
            (406, 43),
            (849, 20),
            (170, 37),
            (509, 75),
            (612, 33),
            (288, 61),
            (319, 81),
            (65, 35),
            (702, 79),
            (582, 27),
            (41, 83),
            (567, 98),
            (22, 48),
            (661, 31),
            (529, 69),
            (108, 60),
            (485, 39),
            (824, 93),
            (848, 35),
            (940, 27),
            (695, 14),
            (737, 82),
            (427, 81),
            (424, 35),
            (671, 72),
            (829, 8),
            (646, 76),
            (93, 31),
            (955, 27),
            (459, 44),
            (809, 91),
            (732, 61),
            (830, 62),
            (854, 10),
            (857, 83),
            (861, 62),
            (550, 68),
            (402, 73),
            (412, 52),
            (368, 7),
            (551, 25),
            (336, 53),
            (51, 55),
            (350, 29),
            (715, 47),
            (375, 93),
            (576, 66),
            (116, 4),
            (529, 26),
            (190, 6),
            (650, 62),
            (4, 7),
            (446, 24),
            (968, 100),
            (202, 52),
            (3, 49),
            (511, 87),
            (81, 36),
            (411, 99),
            (180, 81),
            (656, 93),
            (855, 45),
            (601, 55),
            (28, 95),
            (472, 15),
            (198, 89),
            (25, 86),
            (59, 14),
            (894, 68),
            (647, 63),
            (317, 87),
            (717, 52),
            (422, 48),
            (328, 67),
            (638, 14),
            (100, 93),
            (863, 66),
            (943, 55),
            (944, 84),
            (464, 40),
            (850, 13),
            (18, 71),
            (301, 24),
            (321, 54),
            (104, 58),
            (841, 27),
            (79, 22),
            (767, 17),
            (43, 21),
            (359, 67),
            (605, 42),
            (885, 70),
            (595, 58),
            (731, 74),
            (962, 30),
            (863, 69),
            (221, 51),
            (77, 8),
            (918, 77),
            (129, 4),
            (704, 96),
            (524, 40),
            (130, 5),
            (661, 62),
            (620, 5),
            (460, 62),
            (347, 92),
            (727, 91),
            (325, 5),
            (343, 72),
            (803, 48),
            (939, 10),
            (632, 45),
            (609, 32),
            (162, 77),
            (675, 96),
            (180, 39),
            (568, 85),
            (459, 60),
            (560, 50),
            (971, 69),
            (332, 48),
            (918, 39),
            (412, 59),
            (252, 33),
            (66, 17),
            (650, 30),
            (292, 61),
            (479, 3),
            (557, 82),
            (762, 16),
            (16, 94),
            (742, 81),
            (872, 68),
            (832, 66),
            (667, 95),
            (92, 67),
            (105, 43),
            (765, 78),
            (789, 83),
            (976, 86),
            (328, 8),
            (783, 91),
            (131, 96),
            (167, 40),
            (852, 54),
            (863, 82),
            (35, 96),
            (591, 45),
            (298, 45),
            (51, 18),
            (921, 90),
            (927, 95),
            (282, 28),
            (456, 60),
            (693, 84),
            (844, 93),
            (521, 74),
            (118, 27),
            (313, 17),
            (879, 35),
            (640, 43),
            (931, 46),
            (419, 65),
            (598, 15),
            (882, 49),
            (556, 32),
            (386, 42),
            (424, 58),
            (637, 30),
            (722, 44),
            (544, 71),
            (321, 31),
            (798, 32),
            (540, 8),
            (809, 49),
            (126, 46),
            (652, 42),
            (461, 74),
            (68, 20),
            (696, 72),
            (945, 61),
            (313, 81),
            (913, 59),
            (362, 28),
            (402, 36),
            (591, 73),
            (806, 76),
            (514, 90),
            (662, 65),
            (789, 95),
            (947, 5),
            (193, 84),
            (283, 57),
            (942, 100),
            (175, 66),
            (715, 23),
            (814, 70),
            (851, 52),
            (842, 22),
            (567, 87),
            (997, 9),
            (984, 53),
            (198, 27),
            (804, 69),
            (432, 26),
            (586, 40),
            (433, 63),
            (956, 66),
            (602, 83),
            (921, 53),
            (301, 98),
            (344, 1),
            (46, 55),
            (481, 27),
            (826, 59),
            (357, 47),
            (462, 72),
            (230, 31),
            (212, 78),
            (892, 5),
            (575, 59),
            (241, 51),
            (768, 47),
            (884, 63),
            (588, 92),
            (570, 4),
            (538, 3),
            (428, 48),
            (593, 95),
            (671, 81),
            (977, 98),
            (303, 19),
            (85, 78),
            (951, 23),
            (377, 18),
            (269, 11),
            (325, 18),
            (27, 24),
            (151, 52),
            (20, 28),
            (578, 57),
            (330, 29),
            (490, 93),
            (822, 71),
            (809, 53),
            (804, 38),
            (596, 34),
            (72, 33),
            (718, 1),
            (267, 28),
            (281, 80),
            (816, 40),
            (580, 56),
            (238, 17),
            (877, 63),
            (283, 15),
            (247, 96),
            (127, 85),
            (475, 30),
            (620, 80),
            (926, 23),
            (89, 50),
            (114, 84),
            (578, 48),
            (599, 19),
            (212, 98),
            (690, 6),
            (180, 77),
            (322, 92),
            (504, 28),
            (529, 14),
            (925, 4),
            (845, 10),
            (514, 88),
            (830, 22),
            (655, 54),
            (672, 36),
            (341, 85),
            (579, 79),
            (20, 87),
            (898, 41),
            (973, 88),
            (78, 75),
            (516, 5),
            (985, 25),
            (896, 77),
            (549, 46),
            (687, 82),
            (581, 27),
            (428, 56),
            (633, 86),
            (360, 89),
            (900, 56),
            (185, 98),
            (491, 66),
            (351, 39),
            (725, 78),
            (359, 49),
            (19, 36),
            (123, 93),
            (885, 86),
            (259, 99),
            (711, 96),
            (529, 98),
            (829, 4),
            (756, 47),
            (95, 68),
            (101, 43),
            (822, 65),
            (900, 41),
            (737, 81),
            (833, 13),
            (488, 90),
            (454, 51),
            (413, 55),
            (894, 99),
            (907, 62),
            (580, 34),
            (415, 54),
            (392, 80),
            (97, 75),
            (771, 88),
            (267, 13),
            (321, 85),
            (948, 10),
            (716, 64),
            (42, 87),
            (457, 93),
            (106, 33),
            (813, 11),
            (415, 38),
            (952, 92),
            (439, 57),
            (216, 35),
            (347, 44),
            (876, 27),
            (603, 1),
            (714, 89),
            (585, 45),
            (529, 48),
            (247, 70),
            (942, 86),
            (809, 91),
            (462, 46),
            (867, 16),
            (810, 84),
            (149, 47),
            (796, 48),
            (767, 24),
            (153, 8),
            (673, 1),
            (620, 57),
            (3, 84),
            (176, 77),
            (860, 96),
            (870, 48),
            (270, 10),
            (285, 40),
            (859, 24),
            (158, 66),
            (701, 6),
            (808, 12),
            (18, 19),
            (988, 56),
            (436, 82),
            (616, 19),
            (461, 20),
            (166, 98),
            (463, 77),
            (149, 4),
            (818, 60),
            (227, 22),
            (229, 33),
            (391, 98),
            (192, 32),
            (267, 26),
            (415, 93),
            (123, 39),
            (948, 30),
            (813, 58),
            (289, 27),
            (379, 71),
            (810, 60),
            (593, 1),
            (148, 23),
            (434, 26),
            (349, 30),
            (146, 90),
            (130, 70),
            (706, 98),
            (735, 18),
            (74, 27),
            (278, 11),
            (25, 42),
            (284, 23),
            (218, 58),
            (788, 80),
            (266, 79),
            (268, 41),
            (504, 87),
            (567, 100),
            (71, 31),
            (808, 70),
            (855, 57),
            (373, 62),
            (942, 60),
            (477, 24),
            (989, 14),
            (780, 82),
            (667, 26),
            (295, 62),
            (465, 76),
            (975, 96),
            (853, 73),
            (303, 62),
            (652, 31),
            (299, 65),
            (365, 56),
            (420, 39),
            (294, 67),
            (290, 96),
            (179, 26),
            (920, 86),
            (774, 21),
            (60, 6),
            (473, 61),
            (992, 41),
            (844, 68),
            (529, 9),
            (116, 99),
            (577, 63),
            (637, 41),
            (266, 28),
            (185, 7),
            (138, 86),
            (329, 78),
            (49, 55),
            (642, 92),
            (504, 53),
            (466, 1),
            (253, 7),
            (118, 83),
            (570, 49),
            (42, 81),
            (414, 96),
            (170, 14),
            (634, 29),
            (738, 89),
            (925, 47),
            (883, 75),
            (156, 87),
            (9, 41),
            (187, 80),
            (400, 12),
            (754, 40),
            (120, 47),
            (87, 29),
            (631, 36),
            (974, 63),
            (967, 82),
            (264, 17),
            (738, 91),
            (83, 72),
            (406, 37),
            (592, 82),
            (757, 56),
            (625, 89),
            (451, 64),
            (845, 77),
            (506, 50),
            (898, 79),
            (300, 34),
            (168, 77),
            (657, 36),
            (42, 51),
            (431, 46),
            (176, 9),
            (776, 68),
            (702, 63),
            (735, 16),
            (701, 96),
            (591, 86),
            (772, 14),
            (239, 92),
            (23, 55),
            (93, 12),
            (700, 77),
            (555, 78),
            (174, 7),
            (903, 59),
            (218, 82),
            (851, 64),
            (207, 72),
            (475, 12),
            (325, 26),
            (583, 77),
            (236, 92),
            (513, 49),
            (322, 80),
            (480, 5),
            (657, 4),
            (850, 95),
            (357, 58),
            (676, 55),
            (641, 18),
            (939, 51),
            (844, 21),
            (198, 37),
            (224, 32),
            (508, 45),
            (158, 48),
            (417, 26),
            (269, 63),
            (248, 72),
            (962, 46),
            (510, 84),
            (411, 10),
            (665, 17),
            (55, 16),
            (306, 51),
            (917, 18),
            (901, 53),
            (740, 69),
            (20, 91),
            (802, 100),
            (629, 38),
            (610, 43),
            (157, 58),
            (275, 63),
            (533, 65),
            (160, 60),
            (892, 90),
            (507, 45),
            (166, 27),
            (385, 42),
            (695, 61),
            (541, 55),
            (504, 6),
            (648, 41),
            (540, 82),
            (299, 18),
            (90, 26),
            (400, 13),
            (846, 42),
            (91, 93),
            (967, 79),
            (321, 84),
            (291, 10),
            (511, 51),
            (360, 6),
            (876, 31),
            (13, 72),
            (127, 48),
            (695, 12),
            (848, 5),
            (437, 16),
            (500, 71),
            (817, 37),
            (297, 66),
            (999, 16),
            (982, 88),
            (371, 35),
            (472, 65),
            (487, 73),
            (911, 75),
            (127, 25),
            (149, 26),
            (708, 92),
            (522, 34),
            (7, 28),
            (603, 79),
            (54, 97),
            (672, 7),
            (469, 64),
            (300, 55),
            (974, 79),
            (524, 68),
            (930, 34),
            (526, 64),
            (173, 48),
            (995, 38),
            (64, 49),
            (517, 55),
            (572, 53),
            (29, 82),
            (541, 2),
            (793, 97),
            (302, 58),
            (750, 40),
            (746, 96),
            (100, 10),
            (865, 41),
            (700, 66),
            (474, 14),
            (38, 80),
            (921, 89),
            (425, 4),
            (116, 85),
            (829, 83),
            (439, 2),
            (729, 12),
            (348, 41),
            (62, 87),
            (572, 95),
            (305, 77),
            (812, 50),
            (706, 59),
            (668, 10),
            (94, 76),
            (12, 63),
            (815, 47),
            (190, 25),
            (32, 17),
            (685, 82),
            (869, 32),
            (209, 39),
            (986, 13),
            (84, 50),
            (228, 72),
            (205, 34),
            (363, 99),
            (330, 14),
            (488, 19),
            (58, 88),
            (127, 81),
            (479, 86),
            (935, 93),
            (992, 14),
            (709, 86),
            (736, 37),
            (304, 40),
            (107, 88),
            (150, 38),
            (116, 74),
            (422, 34),
            (205, 13),
            (392, 39),
            (467, 68),
            (855, 65),
            (985, 87),
            (183, 7),
            (223, 68),
            (925, 80),
            (75, 73),
            (480, 5),
            (172, 85),
            (916, 17),
            (898, 89),
            (104, 17),
            (782, 66),
            (877, 79),
            (277, 89),
            (22, 6),
            (730, 62),
            (468, 45),
            (679, 20),
            (792, 85),
            (127, 2),
            (134, 42),
            (543, 5),
            (805, 13),
            (504, 38),
            (429, 64),
            (676, 13),
            (856, 46),
            (391, 17),
            (181, 67),
            (61, 65),
            (623, 62),
            (558, 23),
            (278, 73),
            (584, 66),
            (352, 38),
            (378, 83),
            (221, 68),
            (753, 75),
            (338, 96),
            (540, 74),
            (551, 21),
            (453, 89),
            (670, 48),
            (935, 48),
            (357, 92),
            (31, 62),
            (333, 33),
            (796, 44),
            (528, 1),
            (554, 41),
            (159, 96),
            (883, 71),
            (212, 97),
            (514, 83),
            (259, 56),
            (38, 69),
            (151, 29),
            (417, 86),
            (721, 16),
            (70, 26),
            (223, 32),
            (411, 40),
            (758, 99),
            (60, 74),
            (631, 99),
            (973, 81),
            (445, 11),
            (584, 43),
            (519, 97),
            (537, 72),
            (152, 78),
            (1000, 69),
            (811, 72),
            (538, 80),
            (753, 73),
            (880, 78),
            (358, 61),
            (101, 52),
            (906, 61),
            (983, 41),
            (652, 86),
            (782, 42),
            (511, 57),
            (308, 32),
            (677, 71),
            (585, 35),
            (377, 56),
            (940, 97),
            (723, 45),
            (371, 28),
            (448, 63),
            (66, 12),
            (1000, 100),
            (838, 62),
            (889, 78),
            (261, 24),
            (166, 41),
            (978, 78),
            (31, 62),
            (107, 53),
            (201, 36),
            (195, 91),
            (70, 41),
            (583, 12),
            (907, 74),
            (470, 13),
            (618, 54),
            (740, 53),
            (125, 37),
            (155, 56),
            (243, 22),
            (117, 51),
            (705, 53),
            (538, 92),
            (591, 46),
            (984, 23),
            (108, 74),
            (350, 84),
            (126, 49),
            (104, 89),
            (187, 41),
            (308, 63),
            (277, 11),
            (129, 65),
            (235, 33),
            (668, 37),
            (97, 38),
            (340, 80),
            (88, 90),
            (376, 54),
            (24, 98),
            (991, 41),
            (936, 74),
            (94, 93),
            (48, 90),
            (312, 100),
            (366, 47),
            (672, 64),
            (823, 77),
            (608, 74),
            (904, 79),
            (747, 21),
            (506, 47),
            (331, 96),
            (428, 12),
            (169, 37),
            (722, 90),
            (685, 86),
            (207, 18),
            (372, 23),
            (758, 54),
            (303, 42),
            (817, 53),
            (261, 39),
            (721, 7),
            (605, 97),
            (487, 58),
            (147, 95),
            (284, 55),
            (602, 81),
            (870, 86),
            (230, 19),
            (997, 80),
            (966, 96),
            (973, 71),
            (839, 17),
            (554, 9),
            (104, 33),
            (495, 83),
            (260, 86),
            (882, 64),
            (513, 89),
            (936, 77),
            (545, 47),
            (625, 71),
            (756, 43),
            (387, 58),
            (798, 63),
            (681, 80),
            (541, 16),
            (745, 8),
            (777, 49),
            (983, 62),
            (996, 58),
            (139, 60),
            (889, 16),
            (670, 34),
            (240, 3),
            (867, 33),
            (290, 96),
            (109, 85),
            (950, 17),
            (513, 30),
            (513, 30),
            (217, 52),
            (730, 13),
            (921, 8),
            (802, 92),
            (171, 71),
            (374, 57),
            (271, 21),
            (643, 6),
            (643, 55),
            (252, 62),
            (662, 91),
            (298, 97),
            (885, 73),
            (352, 81),
            (622, 58),
            (177, 4),
            (920, 55),
            (850, 55),
            (621, 72),
            (518, 11),
            (955, 47),
            (293, 78),
            (898, 49),
            (732, 69),
            (335, 80),
            (551, 51),
            (835, 5),
            (907, 17),
            (391, 51),
            (748, 46),
            (396, 90),
            (985, 5),
            (637, 15),
            (510, 45),
            (109, 23),
            (283, 55),
            (454, 51),
            (896, 20),
            (111, 18),
            (1000, 39),
            (713, 46),
            (987, 36),
            (335, 1),
            (380, 13),
            (654, 7),
            (733, 29),
            (267, 4),
            (257, 79),
            (938, 17),
            (816, 79),
            (183, 75),
            (769, 61),
            (483, 90),
            (479, 73),
            (39, 25),
            (677, 38),
            (331, 89),
            (905, 29),
            (168, 3),
            (584, 70),
            (110, 14),
            (480, 51),
            (782, 53),
            (673, 93),
            (506, 30),
            (931, 19),
            (477, 15),
            (67, 69),
            (813, 16),
            (680, 34),
            (720, 65),
            (679, 41),
            (587, 4),
            (132, 16),
            (780, 83),
            (149, 60),
            (637, 53),
            (204, 91),
            (977, 87),
            (999, 90),
            (585, 21),
            (417, 4),
            (841, 72),
            (538, 44),
            (261, 81),
            (749, 89),
            (500, 94),
            (789, 45),
            (350, 53),
            (813, 19),
            (585, 45),
            (887, 98),
            (599, 70),
            (191, 43),
            (903, 100),
            (919, 82),
            (308, 74),
            (139, 95),
            (718, 31),
            (973, 62),
            (981, 56),
            (22, 99),
            (547, 42),
            (381, 51),
            (556, 83),
            (872, 76),
            (24, 46),
            (650, 66),
            (841, 60),
            (288, 49),
            (658, 79),
            (887, 86),
            (27, 13),
            (277, 77),
            (918, 76),
            (860, 38),
            (529, 19);
        ";

        $db->exec($query);
    }
}