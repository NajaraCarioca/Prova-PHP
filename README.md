Respostas da Prova

1) B 

2) E

3) C

4) D

5) 9 Dias

6) ​Ele leva a galinha primeiro, depois volta pega o saco de milho, 
leva pro outro lado, deixa o saco de milho pega a galinha volta pro lado, 
deixa a galinha e pega a raposa, deixa a raposa volta e pega a galinha e 
leva pro outro lado.

7) B

8) A

9) a) C b) S c) M d) A

10) a) 7 b) 62 c) 18 d) 5

a) Uma consulta SQL que retorne todos os talhões da propriedade 20 na safra 2021 ordenada pelo código do talhão.
Select * from talhao where talh_codigo_prop = 20 and talh_safra = 2021 order by talh_codigo asc

b) Uma consulta que mostre a soma das áreas de todas as propriedades.
Select talh_codigo_prop, sum (prop_area) from talhao ta
Inner Join propriedade_agricula pa on pa.talh_codigo_prop = ta.prop_codigo
group by talh_codigo_prop

c) Uma consulta que retorne todos os talhões com código maior que 15 na safra 2022 e da propriedade 5 ordenada pelo código do talhão.
Select * from talhao where talh_codigo > 15 and talh_safra = 2022 and talh_codigo_prop = 5 order by talh_codigo asc

d) Uma consulta que retorne quantos talhões tem na safra 2020.
Select count(talh_codigo) quantidade from talhao where talh_safra = 2020

e) Uma consulta que retorne quantos talhões a propriedade 10 tem na safra 2021.
Select count(talh_codigo) quantidade from talhao where talh_safra = 2020 and talh_codigo_prop = 10
