<?php

require_once 'Persona.php';

/**
 * =============================================================================
 *  TRAIT: Normalizzatore
 * =============================================================================
 *
 *  Concetti OOP dimostrati:
 *  - Trait: meccanismo di riuso del codice (PHP 5.4+)
 *  - Un trait puo essere "iniettato" in qualsiasi classe con la keyword "use"
 *  - Permette di condividere metodi tra classi non correlate gerarchicamente
 *
 *  Perche un Trait e non un metodo della classe?
 *  Questi metodi di manipolazione stringhe potrebbero servire anche ad altre
 *  classi (es. una classe Indirizzo, una classe Anagrafica...).
 *  Il trait evita di duplicare il codice o creare gerarchie artificiali.
 * =============================================================================
 */

trait Normalizzatore {

    // -------------------------------------------------------------------------
    //  METODO FORNITO: normalizza()
    //  Rimuove accenti e converte in maiuscolo
    // -------------------------------------------------------------------------
    private function normalizza(string $str): string {
        $mappa = [
            'à' => 'a', 'á' => 'a', 'è' => 'e', 'é' => 'e',
            'ì' => 'i', 'í' => 'i', 'ò' => 'o', 'ó' => 'o',
            'ù' => 'u', 'ú' => 'u',
        ];
        return strtoupper(strtr($str, $mappa));
    }

    // -------------------------------------------------------------------------
    //  METODO FORNITO: pulisci()
    //  Rimuove tutto cio che non e una lettera A-Z
    // -------------------------------------------------------------------------
    private function pulisci(string $str): string {
        return preg_replace('/[^A-Z]/', '', $str);
    }

    // =========================================================================
    //  SVILUPPA QUI: estraiConsonanti()
    // =========================================================================
    //
    //  Riceve una stringa GIA' normalizzata e maiuscola (es. "ROSSI")
    //  Deve restituire SOLO le consonanti nell'ordine in cui appaiono.
    //
    //  Esempio: "ROSSI" -> "RSS"
    //  Esempio: "ESPOSITO" -> "SPST"
    //
    //  Suggerimento:
    //  - Definisci una stringa con tutte le consonanti: 'BCDFGHJKLMNPQRSTVWXYZ'
    //  - Scorri la stringa con un ciclo for
    //  - Usa strpos() per verificare se il carattere e una consonante
    //  - Se si, aggiungilo al risultato
    //
    //  Firma del metodo:
    //  private function estraiConsonanti(string $str): string
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // =========================================================================
    //  SVILUPPA QUI: estraiVocali()
    // =========================================================================
    //
    //  Riceve una stringa GIA' normalizzata e maiuscola (es. "ROSSI")
    //  Deve restituire SOLO le vocali nell'ordine in cui appaiono.
    //
    //  Esempio: "ROSSI" -> "OI"
    //  Esempio: "ESPOSITO" -> "EOIO"
    //
    //  Suggerimento:
    //  - Definisci una stringa con le vocali: 'AEIOU'
    //  - Stesso approccio di estraiConsonanti()
    //
    //  Firma del metodo:
    //  private function estraiVocali(string $str): string
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================
}


/**
 * =============================================================================
 *  CLASSE: CodiceFiscale (estende Persona, usa Normalizzatore)
 * =============================================================================
 *
 *  Concetti OOP dimostrati:
 *  - Ereditarieta: extends Persona (relazione IS-A)
 *  - Uso di un Trait: use Normalizzatore
 *  - Proprieta statica: $contatore (condivisa tra TUTTE le istanze)
 *  - Metodo statico: getNumeroIstanze() (chiamabile senza oggetto)
 *  - Metodi privati: logica interna non accessibile dall'esterno
 *  - Override: implementazione del metodo astratto getDescrizioneCompleta()
 *  - Chiamata al costruttore padre: parent::__construct()
 * =============================================================================
 */

class CodiceFiscale extends Persona {

    // Inietta i metodi del trait nella classe
    use Normalizzatore;

    // -------------------------------------------------------------------------
    //  PROPRIETA' STATICA
    //  Appartiene alla CLASSE, non alle singole istanze.
    //  Ogni volta che si crea un nuovo CodiceFiscale, il contatore aumenta.
    // -------------------------------------------------------------------------
    private static int $contatore = 0;


    // -------------------------------------------------------------------------
    //  COSTRUTTORE
    //  Chiama il costruttore della classe padre (Persona) e incrementa
    //  il contatore statico.
    // -------------------------------------------------------------------------
    public function __construct(
        string $nome,
        string $cognome,
        string $sesso,
        int    $giorno,
        int    $mese,
        int    $anno,
        string $codiceComune
    ) {
        // Chiama il costruttore di Persona
        parent::__construct($nome, $cognome, $sesso, $giorno, $mese, $anno, $codiceComune);

        // Incrementa il contatore statico (stato condiviso tra tutte le istanze)
        self::$contatore++;
    }


    // -------------------------------------------------------------------------
    //  METODO STATICO: getNumeroIstanze()
    //  Accessibile tramite CodiceFiscale::getNumeroIstanze()
    //  Non ha bisogno di un'istanza per essere chiamato.
    // -------------------------------------------------------------------------
    public static function getNumeroIstanze(): int {
        return self::$contatore;
    }

    // -------------------------------------------------------------------------
    //  METODO STATICO: resetContatore()
    //  Utile per i test: riporta il contatore a zero.
    // -------------------------------------------------------------------------
    public static function resetContatore(): void {
        self::$contatore = 0;
    }


    // =========================================================================
    //  METODO PUBBLICO: genera()
    //  Assembla tutte le parti del codice fiscale.
    //  Questo metodo e GIA' COMPLETO - leggilo per capire come vengono
    //  chiamati i metodi privati che dovrai implementare.
    // =========================================================================
    public function genera(): string {
        $parteCognome = $this->calcolaCognome();       // DA SVILUPPARE
        $parteNome    = $this->calcolaNome();           // DA SVILUPPARE
        $parteAnno    = $this->calcolaAnno();           // DA SVILUPPARE
        $parteMese    = $this->calcolaMese();           // GIA' FORNITO
        $parteGiorno  = $this->calcolaGiornoSesso();   // DA SVILUPPARE
        $parteComune  = strtoupper(trim($this->codiceComune));

        // Assembla i primi 15 caratteri
        $cf15 = $parteCognome . $parteNome . $parteAnno
              . $parteMese . $parteGiorno . $parteComune;

        // Calcola il carattere di controllo (16esimo) - GIA' FORNITO
        $controllo = $this->carattereControllo($cf15);

        return $cf15 . $controllo;
    }


    // =========================================================================
    //  SVILUPPA QUI: calcolaCognome()
    // =========================================================================
    //
    //  Calcola i 3 caratteri del cognome seguendo l'algoritmo:
    //  1. Normalizza il cognome con $this->normalizza()
    //  2. Pulisci con $this->pulisci() (rimuovi caratteri non A-Z)
    //  3. Estrai consonanti con $this->estraiConsonanti()
    //  4. Estrai vocali con $this->estraiVocali()
    //  5. Concatena: consonanti + vocali + 'XXX'
    //  6. Restituisci i primi 3 caratteri con substr()
    //
    //  Nota: usa $this-> per chiamare i metodi del trait (non sono funzioni
    //  globali, sono metodi della classe grazie al trait!)
    //
    //  Firma: private function calcolaCognome(): string
    //
    //  Test:
    //  - "Rossi"    -> "RSS"
    //  - "De Luca"  -> "DLC"
    //  - "Re"       -> "REX"
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // =========================================================================
    //  SVILUPPA QUI: calcolaNome()
    // =========================================================================
    //
    //  Calcola i 3 caratteri del nome con la REGOLA SPECIALE:
    //
    //  1. Normalizza e pulisci il nome
    //  2. Estrai consonanti e vocali
    //  3. SE le consonanti sono >= 4:
    //       -> prendi la 1a, la 3a e la 4a consonante
    //       -> Esempio: "Giuseppe" -> cons="GSPP" -> G + P + P = "GPP"
    //       -> Suggerimento: $consonanti[0] . $consonanti[2] . $consonanti[3]
    //  4. ALTRIMENTI (consonanti < 4):
    //       -> stessa regola del cognome: consonanti + vocali + 'XXX'
    //       -> prendi i primi 3 caratteri
    //
    //  Firma: private function calcolaNome(): string
    //
    //  Test:
    //  - "Mario"      -> "MRA"  (2 cons < 4, regola cognome)
    //  - "Giuseppe"   -> "GPP"  (4 cons >= 4, regola speciale)
    //  - "Alessandro" -> "LSN"  (6 cons >= 4, regola speciale)
    //  - "Ada"        -> "DAA"  (1 cons < 4, regola cognome)
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // =========================================================================
    //  SVILUPPA QUI: calcolaAnno()
    // =========================================================================
    //
    //  Restituisce le ultime 2 cifre dell'anno di nascita come stringa.
    //  Il risultato deve essere SEMPRE di 2 caratteri (con zero iniziale).
    //
    //  Suggerimenti:
    //  - Usa l'operatore modulo: $this->anno % 100
    //  - Usa str_pad() per aggiungere lo zero iniziale se necessario
    //  - Esempio: str_pad((string)($this->anno % 100), 2, '0', STR_PAD_LEFT)
    //
    //  Firma: private function calcolaAnno(): string
    //
    //  Test:
    //  - 1985 -> "85"
    //  - 2001 -> "01"
    //  - 2000 -> "00"
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // -------------------------------------------------------------------------
    //  METODO FORNITO: calcolaMese()
    //  Restituisce la lettera corrispondente al mese di nascita.
    // -------------------------------------------------------------------------
    private function calcolaMese(): string {
        $tabellaMesi = [
            1  => 'A',  2  => 'B',  3  => 'C',  4  => 'D',
            5  => 'E',  6  => 'H',  7  => 'L',  8  => 'M',
            9  => 'P',  10 => 'R',  11 => 'S',  12 => 'T',
        ];
        return $tabellaMesi[$this->mese] ?? '?';
    }


    // =========================================================================
    //  SVILUPPA QUI: calcolaGiornoSesso()
    // =========================================================================
    //
    //  Codifica il giorno di nascita tenendo conto del sesso:
    //  - Maschio ('M'): il giorno resta invariato
    //  - Femmina ('F'): al giorno si aggiunge 40
    //  Il risultato deve essere SEMPRE una stringa di 2 caratteri.
    //
    //  Suggerimenti:
    //  - Usa strtoupper($this->sesso) per confronto sicuro
    //  - if (strtoupper($this->sesso) === 'F') { $giorno = $this->giorno + 40; }
    //  - Poi usa str_pad() per garantire 2 cifre
    //
    //  Firma: private function calcolaGiornoSesso(): string
    //
    //  Test:
    //  - giorno=15, sesso='M' -> "15"
    //  - giorno=15, sesso='F' -> "55"
    //  - giorno=3,  sesso='M' -> "03"
    //  - giorno=1,  sesso='F' -> "41"
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // =========================================================================
    //  SVILUPPA QUI: getDescrizioneCompleta() - Override del metodo astratto
    // =========================================================================
    //
    //  Questo metodo e dichiarato "abstract" nella classe padre Persona.
    //  Qui DEVI implementarlo, altrimenti PHP dara un errore fatale.
    //
    //  Deve restituire una stringa del tipo:
    //  "Mario Rossi, nato il 15/04/1985 (M) - Comune: H501"
    //
    //  Suggerimenti:
    //  - Usa str_pad() per formattare giorno e mese con 2 cifre
    //  - Accedi alle proprieta con $this->nome, $this->cognome, ecc.
    //    (sono protected nel padre, quindi accessibili qui)
    //
    //  Firma: public function getDescrizioneCompleta(): string
    //
    // =========================================================================

    // ... scrivi il metodo qui ...

    // =========================================================================
    //  FINE SVILUPPA QUI
    // =========================================================================


    // -------------------------------------------------------------------------
    //  METODO FORNITO: carattereControllo()
    //  Calcola il 16esimo carattere del codice fiscale.
    //  Non devi modificare questo metodo.
    // -------------------------------------------------------------------------
    private function carattereControllo(string $cf15): string {
        $dispari = [
            '0' => 1,  '1' => 0,  '2' => 5,  '3' => 7,  '4' => 9,
            '5' => 13, '6' => 15, '7' => 17, '8' => 19, '9' => 21,
            'A' => 1,  'B' => 0,  'C' => 5,  'D' => 7,  'E' => 9,
            'F' => 13, 'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21,
            'K' => 2,  'L' => 4,  'M' => 18, 'N' => 20, 'O' => 11,
            'P' => 3,  'Q' => 6,  'R' => 8,  'S' => 12, 'T' => 14,
            'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24,
            'Z' => 23,
        ];
        $pari = [
            '0' => 0,  '1' => 1,  '2' => 2,  '3' => 3,  '4' => 4,
            '5' => 5,  '6' => 6,  '7' => 7,  '8' => 8,  '9' => 9,
            'A' => 0,  'B' => 1,  'C' => 2,  'D' => 3,  'E' => 4,
            'F' => 5,  'G' => 6,  'H' => 7,  'I' => 8,  'J' => 9,
            'K' => 10, 'L' => 11, 'M' => 12, 'N' => 13, 'O' => 14,
            'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18, 'T' => 19,
            'U' => 20, 'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24,
            'Z' => 25,
        ];
        $resto = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $somma = 0;
        for ($i = 0; $i < 15; $i++) {
            $char = strtoupper($cf15[$i]);
            // Posizioni dispari (1,3,5,...) -> indice 0,2,4,... in programmazione
            if ($i % 2 === 0) {
                $somma += $dispari[$char] ?? 0;
            } else {
                $somma += $pari[$char] ?? 0;
            }
        }

        return $resto[$somma % 26];
    }
}
