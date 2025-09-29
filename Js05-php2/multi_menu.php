<?php
$menu = [
  [
    "nama" => "Beranda"
  ],
  [
    "nama" => "Berita",
    "subMenu" => [
      [
        "nama" => "Wisata",
        "subMenu" => [
          [
            "nama" => "Pantai"
          ],
          [
            "nama" => "Gunung"
          ]
        ]
      ],
      [
        "nama" => "Kuliner"
      ],
      [
        "nama" => "Hiburan"
      ]
    ]
  ],
  [
    "nama" => "Tentang"
  ],
  [
    "nama" => "Kontak"
  ]
];

function tampilkanMenuBertingkat (array $menu) {
echo "<ul>";
if (isset($item['subMenu'])){
  echo "<li>{$item['nama']}";
  echo "</li>";
} else{
  echo "<li>{$item['nama']}</li>";
}
echo "</ul>";
}
tampilkanMenuBertingkat ($menu);
?>