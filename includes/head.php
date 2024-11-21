<?php

    require_once (__DIR__ . '/cookies.php');
    
    class Template
    {
        static public function getHead(string $title = 'Hôtel Mermaid')
        {
            $content = '<head>';
            $content .= '<title>' . $title . '</title>';
        
            $content .= '</head>';
        
            return $content;
        }
    }
