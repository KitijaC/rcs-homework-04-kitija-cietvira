-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 07:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(255) NOT NULL,
  `publish_date` datetime NOT NULL,
  `image` text NOT NULL,
  `post_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `user_id`, `publish_date`, `image`, `post_deleted`) VALUES
(1, 'Will by Will Smith', 'One of the most dynamic and globally recognized entertainment forces of our time opens up fully about his life, in a brave and inspiring book that traces his learning curve to a place where outer success, inner happiness, and human connection are aligned. Along the way, Will tells the story in full of one of the most amazing rides through the worlds of music and film that anyone has ever had.\r\n\r\nWill Smith’s transformation from a fearful child in a tense West Philadelphia home to one of the biggest rap stars of his era and then one of the biggest movie stars in Hollywood history, with a string of box office successes that will likely never be broken, is an epic tale of inner transformation and outer triumph, and Will tells it astonishingly well. But it\'s only half the story. \r\n\r\nWill Smith thought, with good reason, that he had won at life: not only was his own success unparalleled, his whole family was at the pinnacle of the entertainment world. Only they didn\'t see it that way: they felt more like star performers in his circus, a seven-days-a-week job they hadn\'t signed up for. It turned out Will Smith\'s education wasn\'t nearly over. \r\n\r\nThis memoir is the product of a profound journey of self-knowledge, a reckoning with all that your will can get you and all that it can leave behind. Written with the help of Mark Manson, author of the multi-million-copy bestseller The Subtle Art of Not Giving a F*ck, Will is the story of how one person mastered his own emotions, written in a way that can help everyone else do the same. Few of us will know the pressure of performing on the world\'s biggest stages for the highest of stakes, but we can all understand that the fuel that works for one stage of our journey might have to be changed if we want to make it all the way home. The combination of genuine wisdom of universal value and a life story that is preposterously entertaining, even astonishing, puts Will the book, like its author, in a category by itself.', 1, '2022-11-08 16:36:48', '364C.tmp.jpg', 0),
(2, 'Because Our Fathers Lied', 'How do we reckon with the sins of our parents? That’s the thorny question at the center of this moving and courageous memoir authored by the son of Robert S. McNamara, Kennedy’s architect of the Vietnam War. In this conflicted son’s telling, a complicated man comes into intimate view, as does the “mixture of love and rage” at the heart of their relationship. At once a loving and neglectful parent, the elder McNamara’s controversial lies about the war ultimately estranged him from his son, who hung Viet Cong flags in his childhood bedroom as a protest. The pursuit of a life unlike his father’s saw the younger McNamara drop out of Stanford and travel through South America on a motorcycle, leading him to ultimately become a sustainable walnut farmer. Through his own personal story of disappointment and disillusionment, McNamara captures an intergenerational conflict and a journey of moral identity.', 1, '2022-11-08 16:38:30', 'C4CE.tmp.jpg', 0),
(3, 'Less Is Lost by Andrew Sean Greer', 'In 2018, Greer won the Pulitzer Prize for Less, an unforgettable comic novel about aging writer Arthur Less and his international misadventures. Less is back for more in this beguiling sequel, bursting with just as much absurdity, heartache, and laugh-out-loud joy as its predecessor. Dogged by financial crisis and the death of his former lover, Less sets out across the American landscape with nothing but a rusty camper van, a somber pug, and a zigzagging itinerary of literary gigs. Our reluctant hero blunders his way into a cascade of disasters, but the more lost Less gets, the closer he is to being found. Rambunctious and life-affirming, Less is Lost is a winsome reminder of all that fiction can do and be. As Greer writes of novelists, “Are we not that fraction of old magic that remains?” Read an exclusive interview with the author here at Esquire.', 1, '2022-11-08 16:40:11', '4E7D.tmp.jpg', 0),
(4, 'How Beautiful We Were', 'Following her 2016 debut, “Behold the Dreamers,” Mbue’s sweeping and quietly devastating second novel begins in 1980 in the fictional African village of Kosawa, where representatives from an American oil company have come to meet with the locals, whose children are dying because of the environmental havoc (fallow fields, poisoned water) wreaked by its drilling and pipelines. This decades-spanning fable of power and corruption turns out to be something much less clear-cut than the familiar David-and-Goliath tale of a sociopathic corporation and the lives it steamrolls. Through the eyes of Kosawa’s citizens young and old, Mbue constructs a nuanced exploration of self-interest, of what it means to want in the age of capitalism and colonialism — these machines of malicious, insatiable wanting.', 2, '2022-11-08 16:41:57', 'EF00.tmp.jpg', 0),
(5, 'The Love Songs of W.E.B. Du Bois', '“The Love Songs of W.E.B. Du Bois,” the first novel by Jeffers, a celebrated poet, is many things at once: a moving coming-of-age saga, an examination of race and an excavation of American history. It cuts back and forth between the tale of Ailey Pearl Garfield, a Black girl growing up at the end of the 20th century, and the “songs” of her ancestors, Native Americans and enslaved African Americans who lived through the formation of the United States. As their stories converge, “Love Songs” creates an unforgettable portrait of Black life that reveals how the past still reverberates today.', 2, '2022-11-08 16:42:28', '67CC.tmp.jpg', 1),
(6, 'No One Is Talking About This', 'Lockwood first found acclaim as a poet on the internet, with gloriously inventive and ribald verse — sexts elevated to virtuosity. In “Priestdaddy,” her indelible 2017 memoir about growing up in rectories across the Midwest presided over by her gun-loving, guitar-playing father, a Catholic priest, she called tweeting “an art form, like sculpture, or honking the national anthem under your armpit.” Here, in her first novel, she distills the pleasures and deprivations of life split between online and flesh-and-blood interactions, transfiguring the dissonance into art. The result is a book that reads like a prose poem, at once sublime, profane, intimate, philosophical, hilarious and, eventually, deeply moving.', 2, '2022-11-08 16:42:58', 'DC14.tmp.jpg', 0),
(7, 'When We Cease to Understand the World', 'Labatut expertly stitches together the stories of the 20th century’s greatest thinkers to explore both the ecstasy and agony of scientific breakthroughs: their immense gains for society as well as their steep human costs. His journey to the outermost edges of knowledge — guided by the mathematician Alexander Grothendieck, the physicist Werner Heisenberg and the chemist Fritz Haber, among others — offers glimpses of a universe with limitless potential underlying the observable world, a “dark nucleus at the heart of things” that some of its witnesses decide is better left alone. This extraordinary hybrid of fiction and nonfiction also provokes the frisson of an extended true-or-false test: The further we read, the blurrier the line gets between fact and fabulism.', 2, '2022-11-08 16:43:26', '4947.tmp.jpg', 0),
(8, 'In Search of Lost Time by Marcel Proust', 'Swann\'s Way, the first part of A la recherche de temps perdu, Marcel Proust\'s seven-part cycle, was published in 1913. In it, Proust introduces the themes that run through the entire work. The narrator recalls his childhood, aided by the famous madeleine; and describes M. Swann\'s passion for Odette. The work is incomparable. Edmund Wilson said \"[Proust] has supplied for the first time in literature an equivalent in the full scale for the new theory of modern physics.\"', 4, '2022-11-08 16:44:21', '206F.tmp.jpg', 0),
(9, 'The Divine Comedy', 'Belonging in the immortal company of the great works of literature, Dante Alighieri\'s poetic masterpiece, The Divine Comedy, is a moving human drama, an unforgettable visionary journey through the infinite torment of Hell, up the arduous slopes of Purgatory, and on to the glorious realm of Paradise — the sphere of universal harmony and eternal salvation.', 4, '2022-11-08 16:45:15', 'F1DA.tmp.jpg', 0),
(10, 'Nuclear Family by Joseph Han', 'In this electric debut novel, we meet the Cho family: Mr. and Mrs. Cho run a popular Korean plate lunch restaurant in Hawai\'i, where they dream of growing the business into a franchise their adult children, Grace and Jacob, will someday inherit. But trouble is brewing on the other side of the Pacific: while teaching English in South Korea, Jacob makes international headlines when he’s arrested for attempting to cross the Demilitarized Zone. Back in Hawai\'i, gossip threatens to sink the family’s fortunes, but the truth is stranger than anyone can imagine: Jacob was possessed by the ghost of his grandfather, who’s desperate to find the family he once abandoned in North Korea. Through a multitude of hilarious and heartbreaking perspectives, Han tells a charged story about identity, migration, and borders.', 2, '2022-11-08 16:54:35', '80C7.tmp.jpg', 0),
(11, 'Nuclear Family by Joseph Han', 'In this electric debut novel, we meet the Cho family: Mr. and Mrs. Cho run a popular Korean plate lunch restaurant in Hawai\'i, where they dream of growing the business into a franchise their adult children, Grace and Jacob, will someday inherit. But trouble is brewing on the other side of the Pacific: while teaching English in South Korea, Jacob makes international headlines when he’s arrested for attempting to cross the Demilitarized Zone. Back in Hawai\'i, gossip threatens to sink the family’s fortunes, but the truth is stranger than anyone can imagine: Jacob was possessed by the ghost of his grandfather, who’s desperate to find the family he once abandoned in North Korea. Through a multitude of hilarious and heartbreaking perspectives, Han tells a charged story about identity, migration, and borders.', 2, '2022-11-08 16:55:13', '14DB.tmp.jpg', 1),
(12, 'The Candy House', 'One of our great American storytellers returns with a rare literary sequel of the very rarest quality. The Candy House enlarges A Visit From the Goon Squad not just by revisiting its memorable characters, but by doubling down on its formal conceits, with many chapters written in texts and emails. In this alternate reality, the world has been forever changed by Own Your Unconsciousness, a popular platform where memories are stored in the cloud and accessible to any user. As Egan hopscotches through the interconnected stories of shared memories, she asks powerful questions about the innate human need for connection, and the price of surrendering our privacy. Of the many novels that have sought to make sense of the social media age, The Candy House is the finest yet.', 4, '2022-11-08 16:58:37', '324B.tmp.jpg', 0),
(13, 'The Candy House', 'One of our great American storytellers returns with a rare literary sequel of the very rarest quality. The Candy House enlarges A Visit From the Goon Squad not just by revisiting its memorable characters, but by doubling down on its formal conceits, with many chapters written in texts and emails. In this alternate reality, the world has been forever changed by Own Your Unconsciousness, a popular platform where memories are stored in the cloud and accessible to any user. As Egan hopscotches through the interconnected stories of shared memories, she asks powerful questions about the innate human need for connection, and the price of surrendering our privacy. Of the many novels that have sought to make sense of the social media age, The Candy House is the finest yet.', 4, '2022-11-08 16:59:33', '973.tmp.jpg', 1),
(14, 'The Candy House', 'One of our great American storytellers returns with a rare literary sequel of the very rarest quality. The Candy House enlarges A Visit From the Goon Squad not just by revisiting its memorable characters, but by doubling down on its formal conceits, with many chapters written in texts and emails. In this alternate reality, the world has been forever changed by Own Your Unconsciousness, a popular platform where memories are stored in the cloud and accessible to any user. As Egan hopscotches through the interconnected stories of shared memories, she asks powerful questions about the innate human need for connection, and the price of surrendering our privacy. Of the many novels that have sought to make sense of the social media age, The Candy House is the finest yet.', 4, '2022-11-08 17:00:02', '7C92.tmp.jpg', 1),
(15, 'The Candy House', 'One of our great American storytellers returns with a rare literary sequel of the very rarest quality. The Candy House enlarges A Visit From the Goon Squad not just by revisiting its memorable characters, but by doubling down on its formal conceits, with many chapters written in texts and emails. In this alternate reality, the world has been forever changed by Own Your Unconsciousness, a popular platform where memories are stored in the cloud and accessible to any user. As Egan hopscotches through the interconnected stories of shared memories, she asks powerful questions about the innate human need for connection, and the price of surrendering our privacy. Of the many novels that have sought to make sense of the social media age, The Candy House is the finest yet.', 4, '2022-11-08 17:00:31', 'EBD8.tmp.jpg', 1),
(16, 'Call Us What We Carry', 'Superstar 23-year-old poet Amanda Gorman was the first National Youth Poet Laureate and in 2021 became the youngest inaugural poet in U.S. history. Her dynamic work is on full display in her breakout collection, Call Us What We Carry: Poems, which includes “The Hill We Climb,” the electrifying piece she recited at President Joe Biden’s inauguration. Call Us What We Carry, which comes in the wake of the pandemic and a national reckoning with systemic racism, serves as a reminder that through struggle and grief, there is always reason to hope for a better future.', 1, '2022-11-11 14:51:47', '16CE.tmp.jpg', 0),
(17, 'Can\'t Even by Anne Helen Petersen', 'Anne Helen Petersen expands her viral essay on millennial burnout into a book. She rejects the stereotype that millennials are lazy and entitled: After suffering through two major recessions, millennials will be the first generation in modern American history who will be less well off than their parents. In exploring how these circumstances came to be, Petersen traces how boomers benefitted from and simultaneously dismantled social and economic programs, leaving their children to grow up to work twice as long for far less pay. Toward the end, Petersen makes a compelling argument that we ought to burn the system down and start anew. The book serves as an essential balm for millennials blaming themselves for economic circumstances beyond their control.', 5, '2022-11-11 15:10:51', '8C5D.tmp.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `text` text NOT NULL,
  `user_id` int(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`text`, `user_id`, `image`) VALUES
('Hello! I am User01 and this is my profile! Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 'ADEF.tmp.jpg'),
('Hello! I am User02 and this is my profile! Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, '1B8B.tmp.jpg'),
('Hello! I am User03 and this is my profile. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 4, '482C.tmp.jpg'),
('Hi! I am User04. This is my profile. here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 5, '8D30.tmp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'user01', 'user01@test.com', '$2y$10$3JgS2S4jMZ9azm1nvQ9U1OP8d87eRDwN4MlhzCj/EaZ4dYzwazLRO'),
(2, 'user02', 'user02@test.com', '$2y$10$OgOE8UW/iaX1F4Bfn5nkm.3q22WX5hhxRDflHhifDTiS7VwCpAYkS'),
(4, 'user03', 'user03@test.com', '$2y$10$DE51QZGOwClmR4AzsjZGdO0wtvq0.MNdgLv3cwMFElgcCKaRJUhDW'),
(5, 'user04', 'user04@test.com', '$2y$10$ifm0GWoRZuD6ZbYfBzDSUuWOvSQUNcvqShDdzj7WAAAAVIgEYm.TS'),
(6, 'user05', 'user05@test.com', '$2y$10$CrL4zM5RWKV/7LWAtbHy1.q8oizlERwQ4V7TMcEiaf3oN5bKQNVgi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
