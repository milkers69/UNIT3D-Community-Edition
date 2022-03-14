<?php

namespace Tests\Feature\Http\Controllers\MediaHub;

use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MediaHub\CompanyController
 */
class CompanyControllerTest extends TestCase
{
    /** @test */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('mediahub.companies.index'));

        $response->assertOk();
        $response->assertViewIs('mediahub.company.index');

        // TODO: perform additional assertions
    }

    /** @test */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $company = \App\Models\Company::factory()->create();

        $response = $this->get(route('mediahub.companies.show', ['id' => $company->id]));

        $response->assertOk();
        $response->assertViewIs('mediahub.company.show');
        $response->assertViewHas('company', $company);
        $response->assertViewHas('shows');
        $response->assertViewHas('movies');

        // TODO: perform additional assertions
    }

    // test cases...
}
