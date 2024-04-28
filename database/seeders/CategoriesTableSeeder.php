<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_category_names = [
            '雑談', '仕事', '文化', '人間関係', '学問'
        ];

        $talk_categories = [
            '自己紹介', '好きなこと', '嫌いなこと', 'ひとりごと'
        ];

        $work_categories = [
            'アルバイト', '転職', '経営', '公務員', '医療業界'
        ];

        $culture_categories = [
            'アニメ', 'ドラマ', '映画', '食べ物', 'ワイン', '居酒屋'
        ];

        $human_relationships_categories = [
            '友情', '恋愛', '結婚', '家族', '職場'
        ];

        $studies_categories = [
            '化学', '物理', '生物', '医学', '薬学'
        ];

        foreach ($major_category_names as $major_category_name) {
            if ($major_category_name == '雑談') {
                foreach ($talk_categories as $talk_category) {
                    Category::create([
                        'name' => $talk_category,
                        'major_category_name' => $major_category_name
                    ]);
                }
            }

            if ($major_category_name == '仕事') {
                foreach ($work_categories as $work_category) {
                    Category::create([
                        'name' => $work_category,
                        'major_category_name' => $major_category_name
                    ]);
                }
            }

            if ($major_category_name == '文化') {
                foreach ($culture_categories as $culture_category) {
                    Category::create([
                        'name' => $culture_category,
                        'major_category_name' => $major_category_name
                    ]);
                }
            }

            if ($major_category_name == '人間関係') {
                foreach ($human_relationships_categories as $human_relationships_category) {
                    Category::create([
                        'name' => $human_relationships_category,
                        'major_category_name' => $major_category_name
                    ]);
                }
            }

            if ($major_category_name == '学問') {
                foreach ($studies_categories as $studies_category) {
                    Category::create([
                        'name' => $studies_category,
                        'major_category_name' => $major_category_name
                    ]);
                }
            }
        }
    }
}
