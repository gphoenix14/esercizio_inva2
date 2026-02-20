<?php

/**
 * =============================================================================
 *  INTERFACCIA: Validabile
 * =============================================================================
 *
 *  Concetti OOP dimostrati:
 *  - Interfaccia: definisce un CONTRATTO (cosa deve fare, non come)
 *  - Qualsiasi classe che implementa Validabile DEVE avere il metodo valida()
 *  - A differenza delle classi astratte, un'interfaccia:
 *    -> NON puo avere proprieta
 *    -> NON puo avere metodi concreti (solo firme)
 *    -> Una classe puo implementare PIU' interfacce
 *
 *  Perche un'interfaccia?
 *  Domani potresti avere ValidatorePartitaIVA, ValidatoreIBAN, ecc.
 *  Tutti implementeranno Validabile, garantendo lo stesso "contratto".
 * =============================================================================
 */

interface Validabile {
    /**
     * Valida il dato e restituisce true se valido, false altrimenti.
     */
    public function valida(): bool;

    /**
     * Restituisce un array di stringhe con gli errori trovati.
     * Se il dato e valido, l'array sara vuoto.
     */
    public function getErrori(): array;
}


/**
 * =============================================================================
 *  CLASSE: ValidatoreCodiceFiscale (implementa Validabile)
 * =============================================================================
 *
 *  Concetti OOP dimostrati:
 *  - Implementazione di un'interfaccia (implements)
 *  - Proprieta private
 *  - Costruttore
 *  - Metodi che soddisfano il contratto dell'interfaccia
 * =============================================================================
 */

class ValidatoreCodiceFiscale implements Validabile {

    // -------------------------------------------------------------------------
    //  PROPRIETA' PRIVATE
    // -------------------------------------------------------------------------
    private string $codiceFiscale;
    private array  $errori = [];


    // -------------------------------------------------------------------------
    //  COSTRUTTORE
    //  Riceve il codice fiscale da validare.
    // -------------------------------------------------------------------------
    public function __construct(string $codiceFiscale) {
        $this->codiceFiscale = strtoupper(trim($codiceFiscale));
    }


    // =========================================================================
    //  SVILUPPA QUI: valida()
    // =========================================================================
    //
    //  Implementa il metodo dell'interfaccia Validabile.
    //  Deve eseguire questi controlli nell'ordine:
    //
    //  1. Verifica che la stringa abbia esattamente 16 caratteri
    //     -> if (strlen($this->codiceFiscale) !== 16)
    //     -> Se fallisce, aggiungi all'array errori:
    //        $this->errori[] = "Il codice fiscale deve avere 16 caratteri";
    //
    //  2. Verifica che contenga solo lettere (A-Z) e numeri (0-9)
    //     -> if (!preg_match('/^[A-Z0-9]+$/', $this->codiceFiscale))
    //     -> Se fallisce: "Il codice fiscale deve contenere solo lettere e numeri"
    //
    //  3. Verifica il pattern esatto (SOLO se i primi 2 controlli sono passati):
    //     -> Le posizioni 1-6 devono essere lettere
    //     -> Le posizioni 7-8 devono essere numeri
    //     -> La posizione 9 deve essere una lettera
    //     -> Le posizioni 10-11 devono essere numeri
    //     -> Le posizioni 12-15 devono essere 1 lettera + 3 numeri
    //     -> La posizione 16 deve essere una lettera
    //
    //     Pattern regex: '/^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$/'
    //     -> Se fallisce: "Il formato del codice fiscale non e valido"
    //
    //  Restituisce true se non ci sono errori, false altrimenti.
    //
    //  Firma: public function valida(): bool
    //
    //  Test:
    //  - "RSSMRA85D15H501S" -> true (valido)
    //  - "RSSMRA85D15H501"  -> false (15 caratteri)
    //  - "RSSMRA85D15H50!S" -> false (carattere speciale)
    //  - "123456789012345A" -> false (pattern errato)
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // =========================================================================
    //  SVILUPPA QUI: getErrori()
    // =========================================================================
    //
    //  Restituisce l'array degli errori trovati durante la validazione.
    //  Se valida() non e stato ancora chiamato, l'array sara vuoto.
    //
    //  Firma: public function getErrori(): array
    //
    //  Suggerimento: e' una sola riga di codice!
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================
}
