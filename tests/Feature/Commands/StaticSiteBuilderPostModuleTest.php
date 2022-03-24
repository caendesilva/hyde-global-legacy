<?php

namespace Tests\Feature\Commands;

use Tests\TestCase;
use Hyde\Framework\Hyde;
use Tests\Setup\ResetsFileEnvironment;

/**
 * Test the post creation module
 *
 * We will use the Alice in Wonderland example post
 * published in the ResetsFileEnvironment stub as
 * we know the contents of it, and expect that
 * the content within will not be modified.
 */
class StaticSiteBuilderPostModuleTest extends TestCase
{
    use ResetsFileEnvironment;
    
    /**
     * The filepath of the post
     *
     * @var string
     */
    protected string $file;

    /**
     * The contents of the file
     *
     * @var string|null
     */
    protected string|null $stream = null;

    public function __construct()
    {
        parent::__construct();

        $this->file = Hyde::path('_site/posts/alice-in-wonderland.html');
        $this->stream = file_get_contents($this->file);
    }
    
    public function test_setup()
    {
        $this->resetFileEnvironment();

        $this->artisan('build');

        $this->assertTrue(true);
    }
    public function test_blog_post_exists()
    {
        $this->assertFileExists($this->file);
    }
    
    public function test_created_post_contains_valid_html()
    {
        $this->assertGreaterThan(1024, filesize($this->file), 'Failed asserting that file is larger than one kilobyte');
        
        $this->assertStringContainsStringIgnoringCase('<!DOCTYPE html>', $this->stream);
        $this->assertStringContainsString('HydePHP', $this->stream);
        $this->assertStringContainsString('tailwind', $this->stream);
    }


    public function test_created_post_contains_expected_content()
    {
        $this->assertStringContainsString('Alice&#039;s Adventures in Wonderland', $this->stream);
        $this->assertStringContainsString('Lewis Carroll', $this->stream);
        $this->assertStringContainsString('<h2>CHAPTER I. DOWN THE RABBIT-HOLE.</h2>', $this->stream);
        $this->assertStringContainsString('So she was considering in her own mind, (as well as she could, for the hot day made her feel very sleepy and stupid,) whether the pleasure of making a daisy-chain would be worth the trouble of getting up and picking the daisies, when suddenly a white rabbit with pink eyes ran close by her.', $this->stream);
        $this->assertStringContainsString('<p><img src="https://upload.wikimedia.org/wikipedia/commons/6/63/Alice_par_John_Tenniel_04.png" alt="Illustration d\'origine (1865), par John Tenniel" /></p>', $this->stream);
    }

    public function test_teardown()
    {
        unset($this->file);
        unset($this->stream);

        $this->assertTrue(true);
    }
}
