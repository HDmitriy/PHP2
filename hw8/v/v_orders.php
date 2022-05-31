<!-- TODO: Сделать поля для ввода данных о юзере + доработать бд для заказов -->

<table border="1px">
	<tr>
		<th>Наименование товара</th>
		<th>Количество (шт.)</th>
	</tr>
	<?php
		$order = 0;
		if ($products) {
			foreach ($products as $product) {
				echo "<tr>
                        <td>" . $product["title"] . "</td>
                        <td>" . $product["count"] . "</td>
                     </tr>";
				$order += $product["count"] * $product["price"];
			}
		}
	?>
</table>
<h2><?= "Итоговая сумма заказа: " . $order . " USD"?></h2>
 
        <form method='post' name='order_form'>
            <input type='hidden' name='order' value=<?php $product["status"] ?> >
            <input type='submit' name='submit' value='Заказать'>
        </form>


<h3><?php if($text){echo $text;}?></h3>