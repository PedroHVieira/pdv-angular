import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ImportLinkComponent } from './import-link.component';

describe('ImportLinkComponent', () => {
  let component: ImportLinkComponent;
  let fixture: ComponentFixture<ImportLinkComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ImportLinkComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ImportLinkComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
