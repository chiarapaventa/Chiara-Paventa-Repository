/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tracciaprova2sol2;
import java.time.LocalDate;
/**
 *
 * @author Chiara
 */

public class SelectYoungPersonFilter implements PersonFilter {

    private final LocalDate maxDate;

    public SelectYoungPersonFilter(int year, int month, int dayOfMonth) {
        this.maxDate = LocalDate.of(year, month, dayOfMonth);
    }

    @Override
    public boolean checkPerson(Person p) {
        return p.getBirthDate().isAfter(maxDate);
    }

}
