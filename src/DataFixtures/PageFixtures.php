<?php

namespace App\DataFixtures;

use App\Entity\Page;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Contracts\Translation\TranslatorInterface;

class PageFixtures extends Fixture
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function load(ObjectManager $manager): void
    {
        $home = new Page();
        $home->setTitle($this->translator->trans("Home"));
        $home->setText("<h1>" . $this->translator->trans("Home") . "</h1>");
        $manager->persist($home);

        $formationCenter = new Page();
        $formationCenter->setTitle($this->translator->trans("Le centre de formation"));
        $formationCenter->setText("<h1>" . $this->translator->trans("Le centre de formation") . "</h1>");
        $manager->persist($formationCenter);

        $catalog = new Page();
        $catalog->setTitle($this->translator->trans("Catalogue"));
        $catalog->setText("<h1>" . $this->translator->trans("Catalogue") . "</h1>");
        $manager->persist($catalog);

        $formationEvaluation = new Page();
        $formationEvaluation->setTitle($this->translator->trans("Evaluer une formation"));
        $formationEvaluation->setText("<h1>" . $this->translator->trans("Evaluer une formation") . "</h1>");
        $manager->persist($formationEvaluation);

        $tutorials = new Page();
        $tutorials->setTitle($this->translator->trans("Tutorials"));
        $tutorials->setText("<h1>" . $this->translator->trans("Tutorials") . "</h1>");
        $manager->persist($tutorials);

        $certification = new Page();
        $certification->setTitle($this->translator->trans("	La certification Qualiopi"));
        $certification->setText("<h1>" . $this->translator->trans("	La certification Qualiopi") . "</h1>");
        $manager->persist($certification);

        $contact = new Page();
        $contact->setTitle($this->translator->trans("Contact"));
        $contact->setText("<h1>" . $this->translator->trans("Contact") . "</h1>");
        $manager->persist($contact);

        $legalsInfos = new Page();
        $legalsInfos->setTitle($this->translator->trans("Infos légales"));
        $legalsInfos->setText("<h1>" . $this->translator->trans("Infos légales") . "</h1>");
        $manager->persist($legalsInfos);

        $confidentialityRules = new Page();
        $confidentialityRules->setTitle($this->translator->trans("Règles de confidentialités"));
        $confidentialityRules->setText("<h1>" . $this->translator->trans("Règles de confidentialités") . "</h1>");
        $manager->persist($confidentialityRules);

        $reserved = new Page();
        $reserved->setTitle($this->translator->trans("Page réservée pour un usage futur"));
        $reserved->setText("<h1>" . $this->translator->trans("Home") . "</h1>");
        $manager->persist($reserved);

        $manager->flush();
    }
}
