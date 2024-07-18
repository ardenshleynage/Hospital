public class java {

    public static void main(String[] args) {
        try {
            new ProcessBuilder("cmd", "/c", "cls").inheritIO().start().waitFor();
        } catch (Exception e) {
            e.printStackTrace();
        }

        System.out.println("Hello Word");
    }

}