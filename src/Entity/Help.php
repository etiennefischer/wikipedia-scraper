<?php

    namespace App\Entity;
    
    class Help {
    
        private $id;
        
        private $name;
        
        private string $description = "Sommaire";
        
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
        