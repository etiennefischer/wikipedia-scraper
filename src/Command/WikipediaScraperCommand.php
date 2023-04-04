<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Goutte\Client;

#[AsCommand(
    name: 'wiki:scraper',
    description: 'Scrapes Wikipedia for a given term and creates classes for each article',
)]
class WikipediaScraperCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to scrape Wikipedia for a given term and create classes for each article')
            ->addArgument('term', InputArgument::REQUIRED, 'The term to search for');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $term = $input->getArgument('term');

        //Scrape wikipedia for the term
        $client = new Client();
        $crawler = $client->request('GET', 'https://fr.wikipedia.org/wiki/' . $term);

        //Extract section titles
        $sectionTitles = $crawler->filter('span.mw-page-title-main')->extract(['_text']);

        //Extract all titles h2 and h3
        $titles = $crawler->filter('h2,h3')->extract(['_text']);
        $firstTitle = $titles[0];

        //Generate classes
        foreach ($sectionTitles as $sectionTitle) {
            $className = $this->generateClassName($sectionTitle);
            $classContent = $this->generateClassContent($className, $firstTitle);
            $classFile = 'src/Entity/' . $className . '.php';
            file_put_contents($classFile, $classContent);
            $output->writeln('Class ' . $className . ' generated successfully');
        }

        $output->writeln('Classes generated successfully');


        return Command::SUCCESS;
    }

    private function generateClassName(string $sectionTitles): string
    {

        return preg_replace('/\s+/', '', ucwords($sectionTitles));
    }

    private function generateClassContent(string $sectionTitle, string $firstTitle) : string
    {
        return '<?php

    namespace App\Entity;
    
    class ' . $sectionTitle . ' {
    
        private $id;
        
        private $name;
        
        private string $description = "' . $firstTitle .'";
        
        private $image;
        
        private $url;
        
        public function getId(): ?int
        {
            return $this->id;
        }
        
        public function getName(): ?string
        {
            return $this->name;
        }
        
        public function setName(string $name): self
        {
            $this->name = $name;
            
            return $this;
        }
        
        public function getDescription(): ?string
        {
            return $this->description;
        }
        
        public function setDescription(string $description): self
        {
            $this->description = $description;
            
            return $this;
        }
        
        public function getImage(): ?string
        {
            return $this->image;
        }
        
        public function setImage(string $image): self
        {
            $this->image = $image;
            
            return $this;
        }
        
        public function getUrl(): ?string
        {
            return $this->url;
        }
        
        public function setUrl(string $url): self
        {
            $this->url = $url;
            
            return $this;
        }
        
    }
        ';

    }




}