# src/Document/Avis.php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping as MongoDB;

/**
 * @MongoDB\Document(collection="avis")
 */
class Avis
{
    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $titre;

    /**
     * @MongoDB\Field(type="string")
     */
    private $contenu;

    /**
     * @MongoDB\Field(type="integer")
     */
    private $note;

    /**
     * @MongoDB\Field(type="string")
     */
    private $auteur;

    /**
     * @MongoDB\Field(type="date")
     */
    private $dateCreation;

    // Getters and setters for all fields
}
