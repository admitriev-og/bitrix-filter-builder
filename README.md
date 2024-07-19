# bitrix-filter-builder

Библиотека предлагает работать с фильтром битрикса в стиле ООП

```
use BitrixFilterBuilder\Filter:

//Инициализация экземпляра класса
$filter = Filter::create(); // или $filter = new Filter;
// Фильтрация по ID c пустым свойством TEST и цена с диапазоне от 1 до 10
$filter->eq('ID', 2)->eq('ID', 2)->isNull('PROPERTY_TEST')->between('CATALOG_PRICE_1', 1, 100);
```

## Основные параметры

eq($field, $value) - Совпадение значения
```
$filter->eq('ID', 2);

//аналогично фильтру битрикс
$filter = ['ID' => 2];
```

neq($field, $value) - Исключить значение
```
$filter->neq('ID', 2);

//аналогично фильтру битрикс
$filter = ['!ID' => 2];
```

like($field, $value) - Поиск по подсроке
```
$filter->like('NAME', 'товар');

//аналогично фильтру битрикс
$filter = ['%NAME' => 'товар'];
```

notLike($field, $value) - Поиск по отсутствию подстроки
```
$filter->notLike('NAME', 'товар');

//аналогично фильтру битрикс
$filter = ['!%NAME' => 'товар'];
```

isNull($field) - Поиск по пустому значению
```
$filter->isNull('PROPERTY_CODE');

//аналогично фильтру битрикс
$filter = ['PROPERTY_CODE' => false];
```

isNotNull($field) - Поиск по заполненному значению
```
$filter->isNotNull('PROPERTY_CODE');

//аналогично фильтру битрикс
$filter = ['!PROPERTY_CODE' => false];
```

in($field, $array) - Соответствие значению массива
```
$filter->in('ID', [1, 2, 3, 4]); // как второй параметр принимает только массив
//можно так же использовать 
$filter->eq('ID', [1, 2, 3, 4]);

//аналогично фильтру битрикс
$filter = ['ID' => [1, 2, 3, 4]];
```

notIn($field, $array) - Исключение значений массива
```
$filter->notIn('ID', [1, 2, 3, 4]); // как второй параметр принимает только массив
//можно так же использовать 
$filter->neq('ID', [1, 2, 3, 4]);

//аналогично фильтру битрикс
$filter = ['!ID' => [1, 2, 3, 4]];
```

## Сравнение

between($field, $min, $max) - Диапозон значений
```
$filter->between('ID', 1, 10);

//аналогично фильтру битрикс
$filter = [
    '>=ID' => 1,
    '<=ID' => 10,
];
```

gte($field, $value) - Больше или равно значения
```
$filter->gte('ID', 10);

//аналогично фильтру битрикс
$filter = ['>=ID' => 10];
```

lte($field, $value) - Меньше или равно значения
```
$filter->lte('ID', 10);

//аналогично фильтру битрикс
$filter = ['<=ID' => 10];
```

gt($field, $value) - Больше значения
```
$filter->gt('ID', 10);

//аналогично фильтру битрикс
$filter = ['>ID' => 10];
```

lt($field, $value) - Меньше значения
```
$filter->lt('ID', 10);

//аналогично фильтру битрикс
$filter = ['<ID' => 10];
```

Получить массив фильтра (методы одинаковы)
```
$arFilter = $filter->getResult();
$arFilter = $filter->toArray();
$arFilter = $filter->jsonSerialize();
```

## Сложная логика

addOrFilter(Filter $filter) - Добавление логики "OR"
```
$subFilter->like('NAME', 'товар');
$subFilter->eq('CODE', 'tovar');
$filter->addOrFilter($subFilter);

//аналогично фильтру битрикс
$filter = [
    [
        'LOGIC' => 'OR',
        '%NAME' => 'товар',
        'CODE' => 'tovar'
    ]
];
```

addAndFilter(Filter $filter) - Добавление логики "AND"
```
$subFilter->like('NAME', 'товар');
$subFilter->neq('NAME', 'товар');
$filter->addAndFilter($subFilter);

//аналогично фильтру битрикс
$filter = [
    [
        'LOGIC' => 'AND',
        '%NAME' => 'товар',
        '!NAME' => 'товар'
    ]
];
```

setFilterLogic($logic) - Установить логику фильтра (OR или AND)
```
$filter->setFilterLogic('OR');

//аналогично фильтру битрикс
$filter = [
    'LOGIC' => 'OR'
];
```

addSubFilter(Filter $filter) - Добавить фильтр как параметр
```
$filter->setFilterLogic('OR');

$subFulter->eq('ID', 5);
$filter->addSubFilter($subFulter);
$subFulter->eq('ID', 10);
$filter->addSubFilter($subFulter);

//аналогично фильтру битрикс
$filter = [
    'LOGIC' => 'OR'
    ['ID' => 5],
    ['ID' => 10],
];
```

mergeWithFilter(Filter $filter) - Объединить фильтры
```
$subFilter->like('NAME', 'товар');
$filter->eq('NAME', 'товар');

$filter->mergeWithFilter($subFilter);
//аналогично фильтру битрикс
$filter = [
    'NAME' => 'товар'
    '%NAME' => 'товар',
];
```