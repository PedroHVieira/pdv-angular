import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ImportScriptComponent } from './import-script.component';

describe('ImportScriptComponent', () => {
  let component: ImportScriptComponent;
  let fixture: ComponentFixture<ImportScriptComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ImportScriptComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ImportScriptComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
