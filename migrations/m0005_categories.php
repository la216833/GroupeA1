<?php

use CashRegister\core\database\DBConnection;

class m0005_categories {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO categories (categoriesName, categoriesDescription) VALUES 
            ('Real Estate Investment Trusts', 'Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.'),
            ('Real Estate Investment Trusts', 'Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.'),
            ('Restaurants', 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Mauris viverra diam vitae quam. Suspendisse potenti.'),
            ('Marine Transportation', 'Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.'),
            ('Medical/Dental Instruments', 'In congue. Etiam justo. Etiam pretium iaculis justo.'),
            ('Natural Gas Distribution', 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.'),
            ('Major Pharmaceuticals', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.'),
            ('n/a', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'),
            ('Telecommunications Equipment', 'Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.'),
            ('n/a', 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Mauris viverra diam vitae quam. Suspendisse potenti.'),
            ('Major Pharmaceuticals', 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.'),
            ('Industrial Machinery/Components', 'In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.'),
            ('Specialty Insurers', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.'),
            ('n/a', 'In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.'),
            ('n/a', 'Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.'),
            ('n/a', 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Mauris viverra diam vitae quam. Suspendisse potenti.'),
            ('Home Furnishings', 'Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.'),
            ('Biotechnology: Biological Products (No Diagnostic Substances)', 'Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.'),
            ('n/a', 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.'),
            ('Oil & Gas Production', 'Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'),
            ('Computer Software: Prepackaged Software', 'Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.'),
            ('EDP Services', 'Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.'),
            ('Other Specialty Stores', 'Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.'),
            ('Major Banks', 'In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.'),
            ('Restaurants', 'Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.'),
            ('n/a', 'Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.'),
            ('Metal Fabrications', 'Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.'),
            ('Diversified Commercial Services', 'Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.'),
            ('Computer Software: Programming, Data Processing', 'Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.'),
            ('Semiconductors', 'Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.'),
            ('Major Pharmaceuticals', 'Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.'),
            ('Major Banks', 'Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.'),
            ('n/a', 'In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.'),
            ('n/a', 'Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.'),
            ('Metal Fabrications', 'Phasellus in felis. Donec semper sapien a libero. Nam dui.'),
            ('n/a', 'In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.'),
            ('Semiconductors', 'Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.'),
            ('Precious Metals', 'Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.'),
            ('n/a', 'In congue. Etiam justo. Etiam pretium iaculis justo.'),
            ('n/a', 'In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.'),
            ('n/a', 'Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.'),
            ('n/a', 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.'),
            ('n/a', 'Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.'),
            ('Television Services', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'),
            ('Business Services', 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Duis faucibus accumsan odio. Curabitur convallis.'),
            ('Business Services', 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Duis faucibus accumsan odio. Curabitur convallis.'),
            ('n/a', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.'),
            ('n/a', 'Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.'),
            ('Commercial Banks', 'Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.'),
            ('Computer Software: Prepackaged Software', 'Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis.Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.');
        ";

        $db->exec($query);
    }
}