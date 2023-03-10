# Technical task - Decoding

***

# Description

Imagine that you are developing a game with an encoded scoring system that stores the results in a file named
`encoded_scores.txt`, an example of its content is as follows:

```
potato,oi8,oo
Best,oF8,Fo
BoLiTa,0123456789,23
Blue,01,01100
Other,54?t,?4?
Manolita,kju2aq,u2ka
Pepper,_-/.!#,#_
```

Implements the code necessary to read the file, process the encoded data, and display the decoded results. 
The facts about the encoding used:

- The manipulated file looks like a CSV file, where the values are separated by commas. Each line contains a user's
  score.
- The first column is the username.
- The second column is the digits of the number system used to code the score.
- The third column is the coded score.

Hints:

- The numbering system digits always appear from least to greatest (for example: 0123456789).
- Manolita's score is 544.
- Other,38 (example: ?4? would be position 212 where 2*4^2+1*4^1+2*4^0 = 38)

The expected results are:
    - Manolita,544
    - Other,38
    - pepper,30
    - boLiTa,23
    - blue,12
    - TheBest,3
    - potato,0

***

## Environment

To start the environment:

```bash
docker compose up -d
```

To stop the environment:

```bash
docker compose down
```

Initialise project:

```bash
docker compose exec app bash initialise
```
