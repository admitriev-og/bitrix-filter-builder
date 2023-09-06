# bitrix-filter-builder

Библиотека предлагает работать с фильтром битрикса в стиле ООП

use BitrixFilterBuilder\Filter:

// инициализация экземпляра класса
$filter = Filter::create(); // или $filter = new Filter;

// Фильтрация по ID c пустым свойством TEST и цена с диапазоне от 1 до 10
$filter->eq('ID', 2)->eq('ID', 2)->isNull('PROPERTY_TEST')->between('CATALOG_PRICE_1', 1, 100);
