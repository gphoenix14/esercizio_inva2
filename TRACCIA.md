# Esercitazione OOP - Codice Fiscale ad Oggetti

## Panoramica

In questa esercitazione dovrai **riscrivere il calcolo del Codice Fiscale** usando la
Programmazione Orientata agli Oggetti (OOP) in PHP, applicando i concetti visti a lezione:

- Classi e Oggetti (costruttore, proprieta, metodi)
- Ereditarieta (`extends`, `parent::`)
- Classi Astratte (`abstract class`)
- Interfacce (`interface`, `implements`)
- Traits (`trait`, `use`)
- Metodi e proprieta statiche (`static`, `self::`)
- Modificatori di accesso (`public`, `private`, `protected`)

**Durata stimata:** 90-120 minuti
**Difficolta:** Intermedio-Avanzato
**Prerequisiti:** Aver completato l'esercitazione procedurale sul Codice Fiscale

---

## Struttura del Progetto

```
esercizio OOP/
    Persona.php                  --> Classe base (astratta)
    CodiceFiscale.php            --> Classe principale di calcolo
    ValidatoreCodiceFiscale.php  --> Interfaccia + Classe di validazione
    index.php                    --> Applicazione web con form HTML
    TRACCIA.md                   --> Questo file
```

---

## Step 1 - Classe Astratta `Persona` (file: `Persona.php`)

**Concetti OOP:** classe astratta, costruttore, proprieta protected, metodo astratto, metodo concreto

La classe `Persona` rappresenta i dati anagrafici di una persona. E' **astratta** perche
da sola non ha senso istanziarla: servira come base per la classe `CodiceFiscale`.

### Cosa devi fare:

1. **Completare il costruttore** che inizializza tutte le proprieta (nome, cognome, sesso, giorno, mese, anno, codiceComune)
2. **Implementare `getNomeCompleto()`** che restituisce "Nome Cognome"
3. **Capire perche `getDescrizioneCompleta()` e abstract** e cosa dovra fare nella classe figlia

### Proprieta (tutte `protected`):
| Proprieta      | Tipo     | Descrizione            |
|----------------|----------|------------------------|
| `$nome`        | string   | Nome della persona     |
| `$cognome`     | string   | Cognome della persona  |
| `$sesso`       | string   | 'M' o 'F'             |
| `$giorno`      | int      | Giorno di nascita      |
| `$mese`        | int      | Mese di nascita (1-12) |
| `$anno`        | int      | Anno di nascita        |
| `$codiceComune`| string   | Codice catastale (es. H501) |

### Test mentale:
> Perche le proprieta sono `protected` e non `private`?
> Risposta: perche la classe figlia `CodiceFiscale` deve potervi accedere.

---

## Step 2 - Trait `Normalizzatore` (file: `CodiceFiscale.php`)

**Concetti OOP:** trait, riuso del codice

Il trait `Normalizzatore` contiene metodi di utilita per manipolare stringhe.
Questi metodi servono sia alla classe `CodiceFiscale` sia potenzialmente ad altre
classi future (es. una classe `Indirizzo`), quindi e corretto metterli in un trait.

### Cosa devi fare:

1. **Implementare `estraiConsonanti()`** - gia visto nell'esercizio procedurale
2. **Implementare `estraiVocali()`** - gia visto nell'esercizio procedurale

I metodi `normalizza()` e `pulisci()` sono gia forniti come riferimento.

---

## Step 3 - Classe `CodiceFiscale` (file: `CodiceFiscale.php`)

**Concetti OOP:** ereditarieta, use trait, proprieta statiche, metodi privati, override metodo astratto

Questa e la classe principale. Estende `Persona` e usa il trait `Normalizzatore`.

### Cosa devi fare:

1. **Completare `calcolaCognome()`** - usa le funzioni del trait per calcolare i 3 caratteri del cognome (stesse regole dell'esercizio procedurale)
2. **Completare `calcolaNome()`** - con la regola speciale (>= 4 consonanti: 1a, 3a, 4a)
3. **Completare `calcolaAnno()`** - ultime 2 cifre con padding
4. **Completare `calcolaGiornoSesso()`** - giorno + 40 se femmina
5. **Implementare `getDescrizioneCompleta()`** - il metodo astratto ereditato da Persona

### Proprieta statica:
La classe ha una proprieta statica `$contatore` che conta quanti codici fiscali sono
stati generati. Questo dimostra il concetto di stato condiviso tra tutte le istanze.

### Metodo statico:
`getNumeroIstanze()` restituisce il valore del contatore.

### Tabella mese (gia fornita):
| Mese | Lettera | Mese | Lettera |
|------|---------|------|---------|
| 1    | A       | 7    | L       |
| 2    | B       | 8    | M       |
| 3    | C       | 9    | P       |
| 4    | D       | 10   | R       |
| 5    | E       | 11   | S       |
| 6    | H       | 12   | T       |

### Test di verifica:
```php
$cf = new CodiceFiscale("Mario", "Rossi", "M", 15, 4, 1985, "H501");
echo $cf->genera();  // Atteso: RSSMRA85D15H501S
echo CodiceFiscale::getNumeroIstanze(); // Atteso: 1
```

---

## Step 4 - Interfaccia `Validabile` e Classe `ValidatoreCodiceFiscale` (file: `ValidatoreCodiceFiscale.php`)

**Concetti OOP:** interfaccia, implements, metodo statico, separazione delle responsabilita

L'interfaccia `Validabile` definisce un contratto: chiunque la implementi deve avere
un metodo `valida()`.

### Cosa devi fare:

1. **Completare il metodo `valida()`** della classe `ValidatoreCodiceFiscale`:
   - Verifica che la stringa abbia esattamente 16 caratteri
   - Verifica che sia composta solo da lettere e numeri (alfanumerica)
   - Verifica il pattern: 6 lettere + 2 numeri + 1 lettera + 2 numeri + 1 lettera + 3 alfanum + 1 lettera
2. **Completare il metodo `getErrori()`** che restituisce l'array degli errori trovati

---

## Step 5 - Applicazione Web `index.php`

**Concetti OOP:** istanziare oggetti, chiamare metodi, usare metodi statici

Il file `index.php` contiene il form HTML (gia fornito) e la logica di elaborazione.

### Cosa devi fare:

1. **Creare un'istanza di `CodiceFiscale`** con i dati dal form
2. **Chiamare il metodo `genera()`** per ottenere il codice fiscale
3. **Creare un'istanza di `ValidatoreCodiceFiscale`** per validare il risultato
4. **Usare il metodo statico** `CodiceFiscale::getNumeroIstanze()`

---

## Casi di Test Finali

Una volta completato tutto, verifica questi casi:

| Cognome   | Nome      | Data       | Sesso | Comune | CF Atteso          |
|-----------|-----------|------------|-------|--------|--------------------|
| Rossi     | Mario     | 15/04/1985 | M     | H501   | RSSMRA85D15H501S   |
| Esposito  | Giuseppe  | 22/08/1990 | M     | F839   | SPSGPP90M22F839D   |
| Bianchi   | Francesca | 01/01/2000 | F     | F205   | BNCFCS00A41F205Z   |
| De Luca   | Ada       | 30/11/1975 | F     | L736   | DLCDAA75S70L736C   |
| Re        | Ugo       | 07/06/2010 | M     | H501   | REXGUO10H07H501G   |

---

## Riepilogo Concetti OOP Utilizzati

| Concetto               | Dove lo trovi                                          |
|------------------------|--------------------------------------------------------|
| Classe astratta        | `Persona` - non puo essere istanziata direttamente     |
| Metodo astratto        | `getDescrizioneCompleta()` in Persona                  |
| Ereditarieta           | `CodiceFiscale extends Persona`                        |
| Trait                  | `Normalizzatore` - riuso di `estraiConsonanti/Vocali`  |
| Proprieta protected    | Tutte le proprieta di `Persona`                        |
| Proprieta private      | Metodi interni di `CodiceFiscale`                      |
| Proprieta statica      | `CodiceFiscale::$contatore`                            |
| Metodo statico         | `CodiceFiscale::getNumeroIstanze()`                    |
| Interfaccia            | `Validabile` implementata da `ValidatoreCodiceFiscale` |
| Modificatori accesso   | `public`, `protected`, `private` usati ovunque         |

---

## Suggerimenti

1. **Leggi TUTTO il codice fornito** prima di iniziare a scrivere
2. **Parti dai metodi piu semplici** (`calcolaAnno`, `calcolaGiornoSesso`) e poi affronta quelli piu complessi
3. **Testa ogni metodo singolarmente** con `echo` prima di passare al successivo
4. **Confronta** il tuo lavoro con l'esercizio procedurale: la logica e identica, cambia solo la struttura
5. **Usa `var_dump()`** per ispezionare valori intermedi durante il debug

Buon lavoro!
