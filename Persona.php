<?php

/**
 * =============================================================================
 *  CLASSE ASTRATTA: Persona
 * =============================================================================
 *
 *  Concetti OOP dimostrati:
 *  - Classe astratta (non puo essere istanziata direttamente)
 *  - Costruttore con inizializzazione proprieta
 *  - Modificatori di accesso: protected (accessibile dalle classi figlie)
 *  - Metodo astratto (deve essere implementato dalla classe figlia)
 *  - Metodo concreto (gia implementato, ereditato dalle classi figlie)
 *
 *  Perche astratta?
 *  Una "Persona" da sola non fa nulla di utile nel nostro contesto.
 *  Serve come BASE per classi piu specifiche come CodiceFiscale.
 *  E' come dire: "ogni CodiceFiscale E' UNA Persona" (relazione IS-A).
 * =============================================================================
 */

abstract class Persona {

    // -------------------------------------------------------------------------
    //  PROPRIETA' (tutte protected: accessibili dalla classe figlia)
    // -------------------------------------------------------------------------
    protected string $nome;
    protected string $cognome;
    protected string $sesso;
    protected int    $giorno;
    protected int    $mese;
    protected int    $anno;
    protected string $codiceComune;


    // =========================================================================
    //  SVILUPPA QUI: Costruttore
    // =========================================================================
    //
    //  Il costruttore deve ricevere 7 parametri e assegnarli alle proprieta.
    //  Parametri: $nome, $cognome, $sesso, $giorno, $mese, $anno, $codiceComune
    //
    //  Suggerimento: usa $this->proprieta = $parametro; per ogni proprieta
    //
    //  Esempio di firma:
    //  public function __construct(string $nome, string $cognome, ...) { ... }
    //
    // =========================================================================

    // ... scrivi il costruttore qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // -------------------------------------------------------------------------
    //  METODO CONCRETO: getNomeCompleto()
    // -------------------------------------------------------------------------

    // =========================================================================
    //  SVILUPPA QUI: getNomeCompleto()
    // =========================================================================
    //
    //  Deve restituire una stringa con "Nome Cognome"
    //  Esempio: "Mario Rossi"
    //
    //  Suggerimento: return $this->nome . ' ' . $this->cognome;
    //
    //  Tipo di ritorno: string
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // -------------------------------------------------------------------------
    //  METODO ASTRATTO: getDescrizioneCompleta()
    // -------------------------------------------------------------------------
    //
    //  Un metodo astratto NON ha corpo (niente parentesi graffe).
    //  La classe figlia DEVE implementarlo, altrimenti PHP dara errore.
    //
    //  Questo metodo dovra restituire una descrizione come:
    //  "Mario Rossi, nato il 15/04/1985 (M) - Comune: H501"
    // -------------------------------------------------------------------------
    abstract public function getDescrizioneCompleta(): string;
}
