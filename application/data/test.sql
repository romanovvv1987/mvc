CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(245) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


INSERT INTO `messages` (`id`, `text`) VALUES
(1, 'While not always necessary, sometimes you need to put your DOM in a box. For those situations, try the panel component.'),
(2, 'List groups are a flexible and powerful component for displaying not only simple lists of elements, but complex ones with custom content.'),
(3, 'Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.'),
(4, 'Includes 200 glyphs in font format from the Glyphicon Halflings set. Glyphicons Halflings are normally not available for free, but their creator has made them available for Bootstrap free of cost. As a thank you, we only ask that you include a l'),
(5, 'For performance reasons, all icons require a base class and individual icon class. To use, place the following code just about anywhere. Be sure to leave a space between the icon and text for proper padding.');
