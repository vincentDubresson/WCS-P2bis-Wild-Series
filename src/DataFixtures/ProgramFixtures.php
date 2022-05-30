<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    protected Slugify $slugify;

    const PROGRAMS = [
        [
            "title" => "Halo",
            "synopsis" => "Au 26e siècle, alors que l’humanité est empêtrée dans une guerre intergalactique contre une menace extraterrestre connue sous le nom d’Alliance, le Dr Halsey, une brillante scientifique, a créé les Spartans, des super-soldats génétiquement et technologiquement améliorés pour booster les capacités physiques et mentales. John-117, le commandant d'une des unités, mène ses troupes vers le combat...",
            "poster" => "https://pictures.betaseries.com/fonds/poster/c8d7465fb30f7d6121735b234fdbd410.jpg",
            "category" => "Fantastique"
        ],
        [
            "title" => "Le bureau des légendes",
            "synopsis" => "Au sein de la DGSE (Direction Générale de la Sécurité Extérieure), un département appelé le bureau des légendes (BDL) pilote à distance les agents les plus importants des services de renseignements français, les clandestins. En immersion dans des pays hostiles, leur mission consiste à repérer les personnes susceptibles d'être recrutées comme source de renseignements. Opérant dans l'ombre \"sous légende\", c'est-à-dire sous une identité fabriquée de toutes pièces, ils vivent durant de longues années dans une duplicité permanente. De retour d'une mission clandestine de six années à Damas, notre héros, plus connu sous le nom de code Malotru, est promu au sein du BDL et reprend peu à peu pied dans sa vraie vie. Mais contrairement à toute procédure de sécurité, il semble ne pas abandonner sa légende et l'identité sous laquelle il vivait en Syrie...",
            "poster" => "https://pictures.betaseries.com/fonds/poster/83e5408fe7a15c6f7a57cdc859cceaf5.jpg",
            "category" => "Crime"
        ],
        [
            "title" => "Stranger Things",
            "synopsis" => "Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse, des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette.",
            "poster" => "https://pictures.betaseries.com/fonds/poster/296076ac6295bd60005737858fd0476c.jpg",
            "category" => "Fantastique"
        ],
        [
            "title" => "Kaamelott",
            "synopsis" => "Ve siècle après Jésus-Christ. L'Angleterre s'appelle encore la Bretagne. Le Christianisme naissant, les anciennes traditions celtes s’entrechoquent pendant que l‘Empire Romain s’effondre. Au carrefour de l’Histoire, le Royaume de Kaamelott apparaît alors comme le nouveau phare de la civilisation. Investi d’une Mission Divine, le Roi Arthur tente de guider son peuple vers la lumière : “Seigneur, je me vouerai tout entier à la noble quête dont Vous m’honorâtes. Mais avec l’équipe de romanos que je me promène, ça va pas être facile!” Entouré de ses Chevaliers, le Roi Arthur règne sur le Royaume de Kaamelott. Kaamelott nous plonge dans la réalité qui se cache derrière la Légende du Roi Arthur : les situations «professionnelles» (missions, quête du Graal, etc.) et les intrigues familiales (repas, scènes conjugales, etc.) nourrissent les coulisses de la Légende. Basé sur le décalage entre situations et dialogues (Jeu et langue contemporains), l’humour de la série oppose l’imagerie épique de la légende Arthurienne à une réalité quotidienne insoupçonnée.",
            "poster" => "https://pictures.betaseries.com/fonds/poster/a06b36dfad9278199e76386368c7f1e0.jpg",
            "category" => "Fantastique"
        ],
        [
            "title" => "Arcane",
            "synopsis" => "Championnes de leurs villes jumelles et rivales, deux sœurs se battent dans une guerre où font rage des technologies magiques et des perspectives diamétralement opposées.",
            "poster" => "https://pictures.betaseries.com/fonds/poster/9ad9ec2a96fe47913df092037536e4ae.jpg",
            "category" => "Fantastique"
        ],
        [
            "title" => "Game of Thrones",
            "synopsis" => "Il y a très longtemps, à une époque oubliée, une force a détruit l'équilibre des saisons. Dans un pays où l'été peut durer plusieurs années et l'hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes. La confrérie de la Garde de Nuit, protégeant le Royaume de toute créature pouvant provenir d'au-delà du Mur protecteur, n'a plus les ressources nécessaires pour assurer la sécurité de tous. Après un été de dix années, un hiver rigoureux s'abat sur le Royaume avec la promesse d'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent sur le continent pour s'emparer du Trône de Fer, le symbole du pouvoir absolu.",
            "poster" => "https://pictures.betaseries.com/fonds/poster/4d09984be7bf0c385b21e2974bc12e8b.jpg",
            "category" => "Fantastique"
        ],
        [
            "title" => "Lupin",
            "synopsis" => "Inspiré par les aventures d'Arsène Lupin, le gentleman cambrioleur Assane Diop décide de venger son père d'une terrible injustice.",
            "poster" => "https://pictures.betaseries.com/fonds/poster/c449a907a8fe53736342cb3ea4d67df5.jpg",
            "category" => "Crime"
        ],
        [
            "title" => "La Casa de Papel",
            "synopsis" => "El Profesor est le cerveau d'un groupe de huit criminels dont l'ambition est de réaliser le braquage parfait : pourquoi attaquer une bijouterie ou une banque, quand on peut s’infiltrer dans l’antre des antres, l’usine de la Monnaie et des Timbres, et fabriquer son propre argent. Pendant 11 jours, l’usine va ainsi être aux mains du groupe, avec 65 otages à l’intérieur. La guerre des nerfs avec les forces d'intervention commence alors...",
            "poster" => "https://pictures.betaseries.com/fonds/poster/dc8f4bf5c841b91fd4df3f524221bd47.jpg",
            "category" => "Crime"
        ],
        [
            "title" => "Breaking Bad",
            "synopsis" => "La vie de Walter White, professeur de chimie dans un lycée, est bouleversée lorsqu'il apprend qu'il est atteint d'un cancer en phase terminale. Une nouvelle qui le sort de la torpeur de son quotidien et l'amène à prendre des mesures radicales pour anticiper l'avenir de sa famille.",
            "poster" => "https://pictures.betaseries.com/fonds/poster/287956ed96886a8debc1b42c82a0a828.jpg",
            "category" => "Crime"
        ],
        [
            "title" => "Peaky Blinders",
            "synopsis" => "À Birmingham, en Angleterre, l'année 1919 est marquée par les exactions de l'impitoyable Tommy Shelby, un jeune chef de la pègre ivre de son désir de domination.",
            "poster" => "https://pictures.betaseries.com/fonds/poster/dec158fbcca5455763a9f8c5a650db34.jpg",
            "category" => "Crime"
        ]
    ];

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        $programNumber = 1;

        foreach (self::PROGRAMS as $programToLoad) {
            $program = new Program();
            $program->setTitle($programToLoad['title']);
            $program->setSlug($this->slugify->generate($programToLoad['title']));
            $program->setSynopsis($programToLoad['synopsis']);
            $program->setPoster($programToLoad['poster']);
            $program->setCategory($this->getReference('category_' . $programToLoad['category']));
            $this->addReference('program_' . $programNumber, $program);
            $programNumber++;
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
          ];
    }
}
