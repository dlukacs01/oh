# oh
OKTATASI HIVATAL exercise task for job interview (final exams score calculator, PHP OOP)

Demo URL: https://dlukacs.com/oh/<br>

HÁZI FELADAT<br>
EGYSZERŰSÍTETT PONTSZÁMÍTÓ KALKULÁTOR<br><br>
Feladat leírása<br><br>
- Input: Jelentkező érettségi adatait tartalmazó tömb
- Output: Jelentkező pontszáma, amennyiben lehetséges<br><br>
-
Alapképzés (BSC) esetén tegyük fel, hogy a felvételi összpontszámot 400+100
(alappont+többletpont) pontos pontszámítási rendszerben kell kiszámítani.<br><br>
Az alappontok számítása az érettségi eredmények függvényében történik.<br><br>
Az érettségi során a felvételizők bizonyos tárgyakból érettségi vizsgát tesznek. Egy
adott tárgyból 0-100% között lehet a felvételiző tantárgyi érettségi eredménye.
Amennyiben valamely tárgyból 20% alatt teljesített a felvételiző, úgy sikertelen az
érettségi eredménye és a pontszámítás nem lehetséges.<br><br>
A jelentkezőknek a következő tárgyakból kötelező érettségi vizsgát tennie: magyar
nyelv és irodalom, történelem és matematika egyéb esetben a pontszámítás nem
lehetséges.<br><br>
Az érettségi tantárgynak létezik típusa, amely vagy közép, vagy emelt szintű lehet.<br><br>
Alappontok számítása:<br><br>
Minden szaknak megvan a maga tárgyi követelményrendszere, amely meghatározza,
hogy mely tárgyakat kell figyelembe venni az alappontok kiszámításához.<br><br>
- Kötelező tárgy: amelyből mindenképpen érettségit kell tennie a jelentkezőnek<br>
- Kötelezően választható tárgyak: olyan tárgyak összesége, amelyből a
jelentkező döntheti el, hogy mely tárgyból vagy tárgyakból szeretne érettségi
vizsgát tenni. Egy tárgyat mindenképpen választani kell.<br><br>
Amennyiben a kötelező tárgyból, vagy egyetlen kötelezően választható tárgyból sem
tett érettségit a hallgató, úgy a pontszámítás nem lehetséges.<br><br>
A kiszámítás során egy tárgy pontértéke (függetlenül a szintjétől) megegyezik a
százalékos eredmény értékével.<br><br>
Az alappontszám megállapításához csak a kötelező tárgy pontértékét és a legjobban
sikerült kötelezően választható tárgy pontértékét kell összeadni és az így kapott
összeget megduplázni.<br><br>

Többletpontok számítása:<br><br>
Nyelvtudás<br>
- Nyelvvizsga: B2/középfokú komplex: 28 pont<br>
- Nyelvvizsga: C1/felsőfokú komplex: 40 pont<br><br>
Emelt szintű érettségi<br>
- Vizsgatárgyanként: 50 pont<br><br>
A többletpontok összege 0 és legfeljebb 100 pont között lehetséges abban az esetben
is, ha a jelentkező különböző jogcímek alapján elért többletpontjainak az összege ezt
meghaladná.<br><br>
Amennyiben a jelentkező egyazon nyelvből tett le több sikeres nyelvvizsgát, úgy a
többletpontszámítás során egyszer kerülnek kiértékelésre a nagyobb pontszám
függvényében (pl.: angol B2 és angol C1 összértéke 40 pont lesz).<br><br>
Összpontszám:<br><br>
Az összpontszámot az alappontok és többletpontok összege adja meg.<br><br>
A könnyebbség kedvéért a feladathoz csak az itt megadott két szak érettségi
követelményrendszerét kell figyelembe venni.<br><br>
Az ELTE IK - Programtervező informatikus:<br>
- Kötelező: matematika<br>
- Kötelezően választható: biológia vagy fizika vagy informatika vagy kémia<br><br>
A PPKE BTK – Anglisztika:<br>
- Kötelező: angol (emelt szinten)<br>
- Kötelezően választható: francia vagy német vagy olasz vagy orosz vagy
spanyol vagy történelem<br><br>
A bemenet és a hozzájuk tartozó kimenet elérhető mellékletben a
homework_input.php fájlban.<br><br>
Jó munkát kívánunk!<br><br>

Elvárások<br><br>
- A megadott feladat visszaküldésére 72 óra áll a rendelkezésére<br>
- PHP nyelven valósítsa meg a kitűzött feladatot<br>
- Nincs szükség CLI vagy felhasználói felület megvalósítására<br>
- OOP alapelvek használata<br>
- Ha nem készült el a teljes megoldással, akkor is küldje el a megoldását<br>
- A megoldását valamilyen verziókövető rendszeren keresztül adja be (GitLab,
GitHub, ...)<br><br>
Bónusz – nem követelmény<br><br>
- Automatizált teszteszközök használata<br>
- Test-driven Development (TDD) által való fejlesztés<br>
- Programtervezési minták használata<br>
- Clean Code (Robert C. Martin) elveinek alkalmazása

