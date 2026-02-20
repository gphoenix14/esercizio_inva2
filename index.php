<?php
/**
 * =============================================================================
 *  APPLICAZIONE WEB: Calcolo Codice Fiscale con OOP
 * =============================================================================
 *
 *  Concetti OOP dimostrati in questo file:
 *  - require_once per includere le classi (ogni classe nel suo file)
 *  - Istanziazione di oggetti con new
 *  - Chiamata di metodi su oggetti ($oggetto->metodo())
 *  - Uso di metodi statici (Classe::metodo())
 * =============================================================================
 */

require_once 'CodiceFiscale.php';
require_once 'ValidatoreCodiceFiscale.php';

// -------------------------------------------------------------------------
//  Array dei comuni (fornito - stessa struttura dell'esercizio procedurale)
// -------------------------------------------------------------------------
$comuni = [
    'H501' => 'Roma',
    'F205' => 'Milano',
    'F839' => 'Napoli',
    'L736' => 'Torino',
    'D612' => 'Firenze',
    'G273' => 'Palermo',
    'A944' => 'Bologna',
    'L049' => 'Bari (San Nicola)',
    'C351' => 'Catania',
    'D969' => 'Genova',
    'B354' => 'Brescia',
    'L781' => 'Trieste',
    'L682' => 'Trento',
    'G482' => 'Perugia',
    'I726' => 'Sassari',
];

// -------------------------------------------------------------------------
//  Variabili per il risultato
// -------------------------------------------------------------------------
$risultato = null;
$erroriForm = [];

// -------------------------------------------------------------------------
//  Elaborazione del form
// -------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recupera i dati dal form
    $cognome      = trim($_POST['cognome'] ?? '');
    $nome         = trim($_POST['nome'] ?? '');
    $sesso        = $_POST['sesso'] ?? '';
    $giorno       = (int)($_POST['giorno'] ?? 0);
    $mese         = (int)($_POST['mese'] ?? 0);
    $anno         = (int)($_POST['anno'] ?? 0);
    $codiceComune = trim($_POST['codice_comune'] ?? '');

    // Validazione base dei campi del form
    if (empty($cognome))      $erroriForm[] = "Il cognome e obbligatorio";
    if (empty($nome))         $erroriForm[] = "Il nome e obbligatorio";
    if (empty($sesso))        $erroriForm[] = "Il sesso e obbligatorio";
    if ($giorno < 1 || $giorno > 31) $erroriForm[] = "Il giorno deve essere tra 1 e 31";
    if ($mese < 1 || $mese > 12)     $erroriForm[] = "Il mese deve essere tra 1 e 12";
    if ($anno < 1900 || $anno > 2026) $erroriForm[] = "L'anno deve essere tra 1900 e 2026";
    if (empty($codiceComune)) $erroriForm[] = "Il codice comune e obbligatorio";

    // Se non ci sono errori, procedi con il calcolo
    if (empty($erroriForm)) {

        // =====================================================================
        //  SVILUPPA QUI: Crea l'oggetto e genera il codice fiscale
        // =====================================================================
        //
        //  1. Crea un'istanza di CodiceFiscale passando tutti i parametri:
        //     $cf = new CodiceFiscale($nome, $cognome, $sesso, $giorno, $mese, $anno, $codiceComune);
        //
        //  2. Chiama il metodo genera() per ottenere il codice fiscale:
        //     $codiceFiscaleGenerato = $cf->genera();
        //
        //  3. Crea un'istanza di ValidatoreCodiceFiscale per validare il risultato:
        //     $validatore = new ValidatoreCodiceFiscale($codiceFiscaleGenerato);
        //
        //  4. Costruisci l'array $risultato con tutte le informazioni:
        //     $risultato = [
        //         'codice_fiscale' => $codiceFiscaleGenerato,
        //         'descrizione'    => $cf->getDescrizioneCompleta(),
        //         'valido'         => $validatore->valida(),
        //         'errori'         => $validatore->getErrori(),
        //         'istanze_create' => CodiceFiscale::getNumeroIstanze(),
        //     ];
        //
        // =====================================================================

        // ... scrivi il codice qui ...

        // =====================================================================
        //  FINE SVILUPPA QUI
        // =====================================================================
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codice Fiscale OOP</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #1a73e8;
            margin-bottom: 8px;
            font-size: 1.8em;
        }
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 0.95em;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #444;
            font-size: 0.9em;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.2s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #1a73e8;
        }
        .row {
            display: flex;
            gap: 15px;
        }
        .row .form-group {
            flex: 1;
        }
        .radio-group {
            display: flex;
            gap: 20px;
            padding: 10px 0;
        }
        .radio-group label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: normal;
            cursor: pointer;
        }
        .radio-group input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: #1a73e8;
        }
        button {
            width: 100%;
            padding: 14px;
            background: #1a73e8;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover { background: #1557b0; }
        .risultato {
            background: #e8f5e9;
            border: 2px solid #4caf50;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
        }
        .risultato .cf {
            font-size: 2.2em;
            font-weight: 700;
            color: #2e7d32;
            letter-spacing: 3px;
            font-family: 'Courier New', monospace;
            margin: 15px 0;
        }
        .risultato .desc {
            color: #555;
            margin-bottom: 10px;
        }
        .risultato .validazione {
            font-size: 0.9em;
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 10px;
        }
        .validazione.ok { background: #c8e6c9; color: #1b5e20; }
        .validazione.ko { background: #ffcdd2; color: #b71c1c; }
        .contatore {
            text-align: center;
            margin-top: 12px;
            font-size: 0.85em;
            color: #888;
        }
        .errori {
            background: #fff3e0;
            border: 2px solid #ff9800;
            border-radius: 12px;
            padding: 20px;
        }
        .errori h3 { color: #e65100; margin-bottom: 10px; }
        .errori ul { padding-left: 20px; }
        .errori li { color: #bf360c; margin-bottom: 4px; }
        .concetti {
            background: #e3f2fd;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }
        .concetti h3 { color: #1565c0; margin-bottom: 12px; }
        .concetti table { width: 100%; border-collapse: collapse; }
        .concetti td {
            padding: 6px 10px;
            border-bottom: 1px solid #bbdefb;
            font-size: 0.9em;
        }
        .concetti td:first-child { font-weight: 600; color: #1565c0; width: 40%; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Codice Fiscale OOP</h1>
        <p class="subtitle">Versione Object-Oriented Programming</p>

        <!-- ERRORI DI VALIDAZIONE -->
        <?php if (!empty($erroriForm)): ?>
            <div class="errori card">
                <h3>Attenzione</h3>
                <ul>
                    <?php foreach ($erroriForm as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- RISULTATO -->
        <?php if ($risultato !== null): ?>
            <div class="risultato card">
                <p class="desc"><?= htmlspecialchars($risultato['descrizione']) ?></p>
                <div class="cf"><?= htmlspecialchars($risultato['codice_fiscale']) ?></div>
                <?php if ($risultato['valido']): ?>
                    <span class="validazione ok">Formato valido</span>
                <?php else: ?>
                    <span class="validazione ko">
                        Formato non valido: <?= htmlspecialchars(implode(', ', $risultato['errori'])) ?>
                    </span>
                <?php endif; ?>
                <div class="contatore">
                    Codici fiscali generati in questa sessione:
                    <strong><?= $risultato['istanze_create'] ?></strong>
                    (proprieta statica)
                </div>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <div class="card">
            <form method="POST">
                <div class="row">
                    <div class="form-group">
                        <label for="cognome">Cognome</label>
                        <input type="text" id="cognome" name="cognome"
                               value="<?= htmlspecialchars($cognome ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome"
                               value="<?= htmlspecialchars($nome ?? '') ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Sesso</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="sesso" value="M"
                                   <?= (($sesso ?? '') === 'M') ? 'checked' : '' ?>>
                            Maschio
                        </label>
                        <label>
                            <input type="radio" name="sesso" value="F"
                                   <?= (($sesso ?? '') === 'F') ? 'checked' : '' ?>>
                            Femmina
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="giorno">Giorno</label>
                        <input type="number" id="giorno" name="giorno" min="1" max="31"
                               value="<?= htmlspecialchars($giorno ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="mese">Mese</label>
                        <select id="mese" name="mese" required>
                            <option value="">-- Seleziona --</option>
                            <?php
                            $nomiMesi = [
                                1=>'Gennaio',2=>'Febbraio',3=>'Marzo',4=>'Aprile',
                                5=>'Maggio',6=>'Giugno',7=>'Luglio',8=>'Agosto',
                                9=>'Settembre',10=>'Ottobre',11=>'Novembre',12=>'Dicembre'
                            ];
                            foreach ($nomiMesi as $num => $nomeMese): ?>
                                <option value="<?= $num ?>"
                                    <?= (($mese ?? 0) == $num) ? 'selected' : '' ?>>
                                    <?= $nomeMese ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="anno">Anno</label>
                        <input type="number" id="anno" name="anno" min="1900" max="2026"
                               value="<?= htmlspecialchars($anno ?? '') ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="codice_comune">Codice Comune (Catastale)</label>
                    <select id="codice_comune" name="codice_comune" required>
                        <option value="">-- Seleziona Comune --</option>
                        <?php foreach ($comuni as $codice => $nomeComune): ?>
                            <option value="<?= $codice ?>"
                                <?= (($codiceComune ?? '') === $codice) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($nomeComune) ?> (<?= $codice ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit">Calcola Codice Fiscale</button>
            </form>
        </div>

        <!-- RIEPILOGO CONCETTI OOP -->
        <div class="concetti card">
            <h3>Concetti OOP utilizzati in questo progetto</h3>
            <table>
                <tr><td>Classe Astratta</td><td>Persona (non istanziabile direttamente)</td></tr>
                <tr><td>Ereditarieta</td><td>CodiceFiscale extends Persona</td></tr>
                <tr><td>Metodo Astratto</td><td>getDescrizioneCompleta() definito in Persona</td></tr>
                <tr><td>Trait</td><td>Normalizzatore (estraiConsonanti, estraiVocali)</td></tr>
                <tr><td>Interfaccia</td><td>Validabile implementata da ValidatoreCodiceFiscale</td></tr>
                <tr><td>Proprieta Statica</td><td>CodiceFiscale::$contatore</td></tr>
                <tr><td>Metodo Statico</td><td>CodiceFiscale::getNumeroIstanze()</td></tr>
                <tr><td>Modificatori Accesso</td><td>public, protected, private</td></tr>
                <tr><td>parent::</td><td>Costruttore di CodiceFiscale chiama Persona</td></tr>
            </table>
        </div>
    </div>
</body>
</html>
